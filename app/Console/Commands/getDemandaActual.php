<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\DemandaActual;
use App\Models\DemandaAlarma;
use App\Models\ConfigKw;
use App\Models\Logs;

class getDemandaActual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-demanda-actual';

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
        $contar = DemandaAlarma::select('id')->count();
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
                    DemandaActual::updateOrCreate(
                        [
                            'id' => 1
                        ],
                        [
                            'kw' => $demandaActual,
                            'factor_potencia' => $factorPotencia,
                        ]
                    );

                    /********************************************************** */
                    // Verificar si se debe activar o desactivar la alarma
                    /********************************************************** */
                    $getAlarma = DemandaAlarma::query()
                        ->where('activa', 1)
                        ->get();
                    $countAlarma = $getAlarma->count();
                    print("Alarma -> {$getAlarma} y son {$countAlarma}\n");

                    if($countAlarma == 0){
                        // Si la demanda supera el setpoint y la alarma no existe, entonces se crea.
                        if($demandaActual >= $configKw->setpoint){
                            DemandaAlarma::create([
                                'kw' => $demandaActual,
                                'activa' => 1,
                                'criticidad' => 'baja'
                            ]);
                        }
                    }else if($countAlarma == 1){
                        // Si la demanda supera el setpoint y la alarma existe, entonces verificamos el tiempo de la alarma y actualizamos la criticidad. 
                        $inicio = $getAlarma->created_at;
                        $fin = $getAlarma->updated_at;

                        $tiempo = $fin->diff($inicio);
                        $tiempo = $tiempo->format('%i');
                        print("Alarma: tiempo transcurrido -> {$tiempo}\n");

                        if($demandaActual >= $configKw->setpoint && $tiempo >= 5){
                            DemandaAlarma::update([
                                'kw' => $demandaActual,
                                'activa' => 1,
                                'criticidad' => 'crítica'
                            ])
                            ->where([
                                'activa' => 1,
                            ]);
                        }else if($demandaActual < $configKw->setpoint){
                            DemandaAlarma::update([
                                'activa' => 0,
                            ])
                            ->where([
                                'activa' => 1,
                            ]);
                        }
                    }
                }                
            }else{
                print("El medidor no está activado\n");
            }
        }
    }
}
