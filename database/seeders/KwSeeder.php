<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\DemandaActual;
use App\Models\ConfigKw;

class KwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DemandaActual::create([
            'kw' => 0,
            'factor_potencia' => 0,
            'mensaje' => 'inactivo',
        ]);

        ConfigKw::create([
            'name' => '',
            'ip' => '0.0.0.0',
            'port' => 80,
            'setpoint' => 0,
            'status' => 0,
        ]);
    }
}
