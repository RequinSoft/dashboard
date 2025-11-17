<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Models\Molienda;
use App\Models\MoliendaConfiguracion;
use App\Models\Logs;

class PlanMolienda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:plan-molienda';

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
        $hoy = Carbon::now();
        $pasadomaniana = $hoy->copy()->addDay(2)->format('Y-m-d');
        $configuracion = MoliendaConfiguracion::first();

        if($configuracion->activo){
            $plan = $configuracion->plan;

            $molienda = Molienda::where('fecha', $pasadomaniana)->first();

            if (!$molienda) {
                // No existe: crear con el plan
                $molienda = Molienda::create([
                    'fecha' => $pasadomaniana,
                    'plan' => $plan,
                    'primer_turno' => 0,
                    'segundo_turno' => 0,
                ]);

                Logs::create([
                    'tipo' => 'System',
                    'mensaje' => 'Se creó el plan de molienda para la fecha '.$pasadomaniana.' con un plan de '.$plan.' toneladas automáticamente.',
                    'created_by' => 1,
                ]);
                print("Se creó el plan de molienda para la fecha ".$pasadomaniana." con un plan de ".$plan." toneladas automáticamente.\n");

            } elseif ($molienda->plan == 0) {
                // Existe pero su plan es 0: actualizarlo
                $molienda->update([
                    'plan' => $plan,
                    'primer_turno' => 0,
                    'segundo_turno' => 0,
                ]);

                Logs::create([
                    'tipo' => 'System',
                    'mensaje' => 'Se actualizó el plan de molienda para la fecha '.$pasadomaniana.' a un plan de '.$plan.' toneladas automáticamente.',
                    'created_by' => 1,
                ]);
                print("Se actualizó el plan de molienda para la fecha ".$pasadomaniana." a un plan de ".$plan." toneladas automáticamente.\n");
            }
            
        }else{
            print("La configuración de plan de molienda automática está desactivada.\n");
        }
    }
}
