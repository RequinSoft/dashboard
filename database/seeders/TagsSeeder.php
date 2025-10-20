<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tags;
use App\Models\ConfigPi;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        ConfigPi::create([
            'ip_pi' => '0.0.0.0',
            'port_pi' => 80,
            'ip_af' => '0.0.0.0',
            'port_af' => 80,
            'activo' => 0,
        ]);

        Tags::create([
            'name' => 'Ritmo de Molienda',
            'description' => 'Ritmo de Molienda',
        ]);

        Tags::create([
            'name' => 'Molienda Diaria',
            'description' => 'Molienda Diaria',
        ]);

        Tags::create([
            'name' => 'Oro',
            'description' => 'Ley de Oro de Cabeza',
        ]);

        Tags::create([
            'name' => 'Plata',
            'description' => 'MLey de Plata de Cabeza',
        ]);

        Tags::create([
            'name' => 'Plomo',
            'description' => 'Ley de Plomo de Cabeza',
        ]);

        Tags::create([
            'name' => 'Zinc',
            'description' => 'Ley de Zinc de Cabeza',
        ]);
    }
}
