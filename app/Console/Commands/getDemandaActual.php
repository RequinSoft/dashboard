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
        $demandaActual = random_int(17000, 25000);
        $factorPotencia = random_int(150, 990) / 100;

        $configKw = ConfigKw::first();
        if($configKw){

            $ultimo = DemandaAlarma::select('id', 'kw', 'created_at', 'activa', 'criticidad')->orderBy('id', 'desc')->take(1)->get();
            




        }

        DemandaActual::updateOrCreate(
            ['id' => 1],
            [
            'kw' => $demandaActual,
            'factor_potencia' => $factorPotencia,
            ]
        );
    }
}
