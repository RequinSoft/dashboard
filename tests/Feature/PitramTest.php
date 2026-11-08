<?php

namespace Tests\Feature;

use App\Models\PitramToken;
use App\Services\PitramClient;
use App\Services\PitramException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\Console\Output\BufferedOutput;
use Tests\TestCase;

class PitramTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.key' => 'base64:'.base64_encode(str_repeat('a', 32)),
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'services.pitram' => [
                'host' => 'pitram.test:8080',
                'scheme' => 'http',
                'username' => 'test-user',
                'password' => 'test-password',
                'token_endpoint' => '/token',
                'equipment_endpoint' => '/api/equipment',
            ],
        ]);
        DB::purge('sqlite');
        (require database_path('migrations/2026_11_08_000000_create_pitram_tokens_table.php'))->up();
        (require database_path('migrations/2025_09_10_162456_equipos.php'))->up();
        Http::preventStrayRequests();
        Log::spy();
    }

    private function tokenResponse(string $token = 'fake-token'): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600,
        ];
    }

    public function test_authentication_sends_form_and_persists_encrypted_hidden_token(): void
    {
        Http::fake(['*/token' => Http::response($this->tokenResponse())]);

        $this->artisan('app:get-pitram-token')->assertSuccessful();

        Http::assertSent(fn (Request $request) => $request->url() === 'http://pitram.test:8080/token'
            && $request->method() === 'POST'
            && $request->hasHeader('Content-Type', 'application/x-www-form-urlencoded')
            && $request['grant_type'] === 'password'
            && $request['username'] === 'test-user'
            && $request['password'] === 'test-password');

        $token = PitramToken::findOrFail(1);
        $this->assertSame('fake-token', $token->access_token);
        $this->assertArrayNotHasKey('access_token', $token->toArray());
        $this->assertStringNotContainsString('fake-token', DB::table('pitram_tokens')->value('access_token'));
        $this->assertEqualsWithDelta(3540, now()->diffInSeconds($token->expires_at), 2);
    }

    public function test_valid_token_is_reused_and_expired_token_is_replaced(): void
    {
        PitramToken::updateOrCreate(['id' => 1], [
            'access_token' => 'stored-token',
            'expires_at' => now()->addHour(),
        ]);
        Http::fake(['*/token' => Http::response($this->tokenResponse('new-token'))]);
        $client = app(PitramClient::class);

        $this->assertSame('stored-token', $client->token()->access_token);
        Http::assertNothingSent();

        PitramToken::findOrFail(1)->update(['expires_at' => now()->subSecond()]);
        $this->assertSame('new-token', $client->token()->access_token);
        $this->assertSame(1, PitramToken::count());
        Http::assertSentCount(1);
    }

    public function test_refresh_forces_new_authentication(): void
    {
        PitramToken::updateOrCreate(['id' => 1], [
            'access_token' => 'stored-token',
            'expires_at' => now()->addHour(),
        ]);
        Http::fake(['*/token' => Http::response($this->tokenResponse('refreshed-token'))]);

        $this->artisan('app:get-pitram-token', ['--refresh' => true])->assertSuccessful();

        $this->assertSame('refreshed-token', PitramToken::findOrFail(1)->access_token);
        Http::assertSentCount(1);
    }

    public function test_token_is_recreated_with_fixed_id_after_deletion(): void
    {
        Http::fake(['*/token' => Http::response($this->tokenResponse())]);
        $client = app(PitramClient::class);
        $client->token()->delete();

        $this->assertSame(1, $client->token()->id);
        $this->assertSame(1, PitramToken::count());
    }

    public function test_diagnostic_uses_bearer_and_displays_structure_without_values_or_saving_equipment(): void
    {
        Http::fake([
            '*/token' => Http::response($this->tokenResponse()),
            '*/api/equipment' => Http::response([
                'Equipment' => [['EquipmentId' => 42, 'Name' => 'private-equipment', 'Active' => true]],
                'NextPage' => 'private-page-link',
            ]),
        ]);

        $output = new BufferedOutput;
        $this->assertSame(0, Artisan::call('app:diagnose-pitram-equipment', [], $output));
        $text = $output->fetch();
        $this->assertStringContainsString('"EquipmentId"', $text);
        $this->assertStringContainsString('"Name"', $text);
        $this->assertStringContainsString('"NextPage"', $text);
        $this->assertStringNotContainsString('private-equipment', $text);
        $this->assertStringNotContainsString('private-page-link', $text);
        $this->assertStringNotContainsString('fake-token', $text);
        preg_match('/\{.*\}/s', $text, $matches);
        $this->assertSame([
            'type' => 'object',
            'count' => 2,
            'fields' => [
                'Equipment' => [
                    'type' => 'array',
                    'count' => 1,
                    'items' => [
                        'type' => 'object',
                        'count' => 3,
                        'fields' => [
                            'EquipmentId' => ['type' => 'int'],
                            'Name' => ['type' => 'string'],
                            'Active' => ['type' => 'bool'],
                        ],
                    ],
                ],
                'NextPage' => ['type' => 'string'],
            ],
        ], json_decode($matches[0], true, 512, JSON_THROW_ON_ERROR));

        Http::assertSent(fn (Request $request) => $request->method() === 'GET'
            && $request->url() === 'http://pitram.test:8080/api/equipment'
            && $request->hasHeader('Authorization', 'Bearer fake-token'));
        $this->assertSame(0, DB::table('equipos')->count());
    }

    public function test_unauthorized_equipment_response_renews_token_once(): void
    {
        PitramToken::updateOrCreate(['id' => 1], [
            'access_token' => 'old-token',
            'expires_at' => now()->addHour(),
        ]);
        Http::fake([
            '*/token' => Http::response($this->tokenResponse('new-token')),
            '*/api/equipment' => Http::sequence()->push([], 401)->push([['Name' => 'fake-equipment']]),
        ]);

        $this->assertSame([['Name' => 'fake-equipment']], app(PitramClient::class)->equipment());
        Http::assertSentCount(3);
        Http::assertSent(fn (Request $request) => $request->hasHeader('Authorization', 'Bearer new-token'));
    }

    public function test_repeated_unauthorized_response_fails_without_looping_or_showing_body(): void
    {
        Http::fake([
            '*/token' => Http::response($this->tokenResponse()),
            '*/api/equipment' => Http::response('secret-body', 401),
        ]);

        $this->artisan('app:diagnose-pitram-equipment')
            ->expectsOutputToContain('HTTP 401')
            ->doesntExpectOutputToContain('secret-body')
            ->assertFailed();

        Http::assertSentCount(4);
    }

    #[DataProvider('invalidTokens')]
    public function test_invalid_token_response_does_not_replace_stored_token(array $response): void
    {
        PitramToken::updateOrCreate(['id' => 1], [
            'access_token' => 'original-token',
            'expires_at' => now()->subSecond(),
        ]);
        Http::fake(['*/token' => Http::response($response)]);

        $this->artisan('app:get-pitram-token')
            ->expectsOutputToContain('vigencia validos')
            ->assertFailed();

        $this->assertSame('original-token', PitramToken::findOrFail(1)->access_token);
    }

    public static function invalidTokens(): array
    {
        return [
            'missing token' => [['token_type' => 'bearer', 'expires_in' => 3600]],
            'blank token' => [['access_token' => ' ', 'token_type' => 'bearer', 'expires_in' => 3600]],
            'header injection' => [['access_token' => "token\r\ninvalid", 'token_type' => 'bearer', 'expires_in' => 3600]],
            'wrong type' => [['access_token' => 'fake', 'token_type' => 'basic', 'expires_in' => 3600]],
            'expired' => [['access_token' => 'fake', 'token_type' => 'bearer', 'expires_in' => 0]],
            'missing expiry' => [['access_token' => 'fake', 'token_type' => 'bearer']],
        ];
    }

    public function test_http_error_is_reported_without_sensitive_body(): void
    {
        Http::fake(['*/token' => Http::response('test-password secret-token', 500)]);

        $this->artisan('app:get-pitram-token')
            ->expectsOutputToContain('HTTP 500')
            ->doesntExpectOutputToContain('test-password')
            ->doesntExpectOutputToContain('secret-token')
            ->assertFailed();

        Log::shouldHaveReceived('error')->once()->with('Pitram devolvio HTTP 500 en autenticacion.');
        $this->assertSame(0, PitramToken::count());
    }

    public function test_connection_failure_is_reported_without_sensitive_details(): void
    {
        Http::fake(['*/token' => Http::failedConnection('test-password secret-token')]);

        $this->artisan('app:get-pitram-token')
            ->expectsOutputToContain('No se pudo conectar')
            ->doesntExpectOutputToContain('test-password')
            ->doesntExpectOutputToContain('secret-token')
            ->assertFailed();
    }

    public function test_non_json_equipment_response_fails_explicitly(): void
    {
        Http::fake([
            '*/token' => Http::response($this->tokenResponse()),
            '*/api/equipment' => Http::response('<html>private-body</html>'),
        ]);

        $this->artisan('app:diagnose-pitram-equipment')
            ->expectsOutputToContain('JSON valido')
            ->doesntExpectOutputToContain('private-body')
            ->assertFailed();
    }

    public function test_absolute_endpoints_are_supported(): void
    {
        config(['services.pitram.token_endpoint' => 'https://pitram.test/oauth/token']);
        Http::fake(['https://pitram.test/oauth/token' => Http::response($this->tokenResponse())]);

        $this->assertSame('fake-token', app(PitramClient::class)->token()->access_token);
        Http::assertSent(fn (Request $request) => $request->url() === 'https://pitram.test/oauth/token');
    }

    public function test_redirect_does_not_forward_credentials(): void
    {
        Http::fake(['*/token' => Http::response('', 302, ['Location' => 'https://other.test/token'])]);

        $this->artisan('app:get-pitram-token')
            ->expectsOutputToContain('HTTP 302')
            ->assertFailed();

        Http::assertSentCount(1);
        $options = Http::recorded()[0][0]->toPsrRequest();
        $this->assertSame('pitram.test', $options->getUri()->getHost());
    }

    public function test_missing_configuration_fails_before_http_request(): void
    {
        config(['services.pitram.username' => '']);
        Http::fake();

        $this->expectException(PitramException::class);
        $this->expectExceptionMessage('Falta configurar services.pitram.username');

        try {
            app(PitramClient::class)->token();
        } finally {
            Http::assertNothingSent();
        }
    }
}
