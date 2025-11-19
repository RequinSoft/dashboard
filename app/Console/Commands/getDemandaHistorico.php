<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Demanda;
use App\Models\ConfigKw;
use App\Models\Logs;

class getDemandaHistorico extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-demanda-historico';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $demandaActual = 0;
        $factorPotencia = 0;

        // Validar si la configuración de KW está activa
        $configKw = ConfigKw::first();

        if($configKw){
            if($configKw->status == 1){
                
                // Si la configuración está activa, obtener la demanda actual
                $getDemanda = getDemanda($configKw->ip, $configKw->port);

                if($getDemanda['demanda'] == 'No hay conexión'){
                    print($getDemanda['demanda']."\n");

                    Logs::create([
                        'tipo' => 'demanda',
                        'mensaje' => $getDemanda['demanda'],
                        'created_by' => 'sistema',
                    ]);
                }else{
                    $demandaActual = $getDemanda['demanda'];
                    $factorPotencia = $getDemanda['pf'];

                    // Guardar en la base de datos la demanda actual
                    Demanda::create(
                        [
                            'kw' => $demandaActual,
                            'factor_potencia' => $factorPotencia,
                        ]
                    );
                }                
            }else{
                print("El medidor no está activado\n");
            }
        }
    }
}
