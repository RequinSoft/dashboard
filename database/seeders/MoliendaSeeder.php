<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Molienda;
use App\Models\MoliendaConfiguracion;

class MoliendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configuracion = MoliendaConfiguracion::create([
            'activo' => false,
            'plan' => 0,
        ]);

        // Crear registros de molienda para todo el año 2025 con plan 0
        $startDate = \Carbon\Carbon::create(2025, 1, 1);
        $endDate = \Carbon\Carbon::create(2025, 12, 31);

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            Molienda::create([
                'fecha' => $date->format('Y-m-d'),
                'plan' => 0,
            ]);
        }
    }
}
