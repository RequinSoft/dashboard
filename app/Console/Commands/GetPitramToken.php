<?php

namespace App\Console\Commands;

use App\Services\PitramClient;
use App\Services\PitramException;
use Illuminate\Console\Command;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class GetPitramToken extends Command
{
    protected $signature = 'app:get-pitram-token {--refresh : Solicitar un nuevo token aunque el guardado siga vigente}';

    protected $description = 'Obtiene y guarda cifrado el token de Pitram en la base de datos';

    public function handle(PitramClient $client): int
    {
        try {
            $token = $client->token((bool) $this->option('refresh'));
        } catch (PitramException $exception) {
            Log::error($exception->getMessage());
            $this->error($exception->getMessage());

            return self::FAILURE;
        } catch (QueryException|DecryptException $exception) {
            Log::error('No se pudo leer o guardar el token de Pitram.', ['error_type' => $exception::class]);
            $this->error('No se pudo leer o guardar el token. Revisa las migraciones, la conexion DB y APP_KEY.');

            return self::FAILURE;
        }

        $this->info('Token de Pitram guardado cifrado. Vigencia local: '.$token->expires_at->toIso8601String());

        return self::SUCCESS;
    }
}
