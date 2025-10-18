<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\DemandaActual;
use App\Models\DemandaAlarma;
use App\Models\ConfigKw;

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
                $demandaActual = $getDemanda['demanda'];
                $factorPotencia = $getDemanda['pf'];
            }
        }

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
            ->count();


    }
}
