<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\DemandaActual;

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
        $demandaActual = random_int(17000, 25000);
        $factorPotencia = random_int(150, 990) / 100;

        DemandaActual::updateOrCreate(
            ['id' => 1],
            [
            'kw' => $demandaActual,
            'factor_potencia' => $factorPotencia,
            ]
        );
    }
}
