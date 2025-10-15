<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\DemandaActual;

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
        ]);
    }
}
