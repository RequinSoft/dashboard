<?php

namespace App\Console\Commands;

use App\Services\PitramClient;
use App\Services\PitramException;
use Illuminate\Console\Command;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DiagnosePitramEquipment extends Command
{
    protected $signature = 'app:diagnose-pitram-equipment {--refresh : Renovar el token antes de consultar}';

    protected $description = 'Consulta la estructura JSON de equipos de Pitram sin mostrar valores ni guardar equipos';

    public function handle(PitramClient $client): int
    {
        try {
            $data = $client->equipment((bool) $this->option('refresh'));
        } catch (PitramException $exception) {
            Log::error($exception->getMessage());
            $this->error($exception->getMessage());

            return self::FAILURE;
        } catch (QueryException|DecryptException $exception) {
            Log::error('No se pudo leer o guardar el token de Pitram.', ['error_type' => $exception::class]);
            $this->error('No se pudo leer o guardar el token. Revisa las migraciones, la conexion DB y APP_KEY.');

            return self::FAILURE;
        }

        $this->info('Consulta completada. Solo se muestran campos, tipos y cantidades; no se guardaron equipos.');
        $this->line(json_encode($this->structure($data), JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));
        $this->warn('Los arreglos muestran la estructura del primer elemento. Confirma el mapeo y la paginacion antes de importar.');

        return self::SUCCESS;
    }

    private function structure(mixed $value, int $depth = 0): array
    {
        if (! is_array($value)) {
            return ['type' => get_debug_type($value)];
        }

        $list = array_is_list($value);
        $result = ['type' => $list ? 'array' : 'object', 'count' => count($value)];

        if ($depth >= 6) {
            return $result + ['truncated' => true];
        }

        if ($list) {
            if ($value !== []) {
                $result['items'] = $this->structure($value[0], $depth + 1);
            }
        } else {
            foreach (array_slice($value, 0, 50, true) as $key => $item) {
                $result['fields'][$key] = $this->structure($item, $depth + 1);
            }

            if (count($value) > 50) {
                $result['truncated'] = true;
            }
        }

        return $result;
    }
}
