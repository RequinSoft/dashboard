<?php

namespace App\Services;

use App\Models\PitramToken;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PitramClient
{
    public function token(bool $refresh = false): PitramToken
    {
        $url = $this->endpoint('token_endpoint');
        $username = $this->setting('username');
        $password = $this->setting('password');
        $stored = PitramToken::find(1);

        if (! $refresh && $stored && $stored->expires_at->isFuture()) {
            return $stored;
        }

        try {
            $response = $this->request()->asForm()->post($url, [
                'grant_type' => 'password',
                'username' => $username,
                'password' => $password,
            ]);
        } catch (ConnectionException) {
            throw new PitramException('No se pudo conectar con Pitram para obtener el token.');
        }

        $this->checkResponse($response, 'autenticacion');
        $data = $response->json();

        if (! is_array($data)
            || ! is_string($data['access_token'] ?? null)
            || trim($data['access_token']) === ''
            || preg_match('/[\r\n]/', $data['access_token'])
            || ! is_string($data['token_type'] ?? null)
            || strtolower($data['token_type']) !== 'bearer'
            || ! is_int($data['expires_in'] ?? null)
            || $data['expires_in'] <= 0) {
            throw new PitramException('La respuesta de autenticacion de Pitram no contiene un token Bearer y una vigencia validos.');
        }

        $margin = min(60, intdiv($data['expires_in'], 10));

        return PitramToken::updateOrCreate(['id' => 1], [
            'access_token' => $data['access_token'],
            'expires_at' => now()->addSeconds($data['expires_in'] - $margin),
        ]);
    }

    public function equipment(bool $refresh = false): array
    {
        $url = $this->endpoint('equipment_endpoint');
        $token = $this->token($refresh);
        $response = $this->getEquipment($url, $token);

        if ($response->status() === 401) {
            $response = $this->getEquipment($url, $this->token(true));
        }

        $this->checkResponse($response, 'equipos');
        $data = $response->json();

        if (! is_array($data)) {
            throw new PitramException('El listado de equipos de Pitram no es un objeto o arreglo JSON valido.');
        }

        return $data;
    }

    private function getEquipment(string $url, PitramToken $token): Response
    {
        try {
            return $this->request()->withToken($token->access_token)->get($url);
        } catch (ConnectionException) {
            throw new PitramException('No se pudo conectar con Pitram para consultar equipos.');
        }
    }

    private function request(): PendingRequest
    {
        return Http::acceptJson()->connectTimeout(10)->timeout(30)->withoutRedirecting();
    }

    private function checkResponse(Response $response, string $operation): void
    {
        if (! $response->successful()) {
            throw new PitramException("Pitram devolvio HTTP {$response->status()} en {$operation}.");
        }
    }

    private function setting(string $key): string
    {
        $value = config("services.pitram.{$key}");

        if (! is_string($value) || trim($value) === '') {
            throw new PitramException("Falta configurar services.pitram.{$key} en el .env.");
        }

        return $value;
    }

    private function endpoint(string $key): string
    {
        $endpoint = $this->setting($key);

        if (preg_match('~^https?://~i', $endpoint)) {
            $url = $endpoint;
        } else {
            $host = $this->setting('host');
            $scheme = $this->setting('scheme');

            if (! in_array($scheme, ['http', 'https'], true)) {
                throw new PitramException('PITRAM_SCHEME debe ser http o https.');
            }

            $base = preg_match('~^https?://~i', $host) ? $host : "{$scheme}://{$host}";
            $url = rtrim($base, '/').'/'.ltrim($endpoint, '/');
        }

        $parts = parse_url($url);

        if ($parts === false || ! in_array($parts['scheme'] ?? '', ['http', 'https'], true)
            || empty($parts['host']) || isset($parts['user']) || isset($parts['pass'])
            || isset($parts['fragment'])) {
            throw new PitramException("La direccion configurada para {$key} no es valida.");
        }

        return $url;
    }
}
