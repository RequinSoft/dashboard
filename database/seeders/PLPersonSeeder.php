<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PLPerson;

class PLPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PLPerson::create([
            'name' => 'Juan Pérez',
            'position' => 'Gerente de Proyectos',
            'image' => null,
        ]);

        PLPerson::create([
            'name' => 'María Gómez',
            'position' => 'Analista de Datos',
            'image' => null,
        ]);

        PLPerson::create([
            'name' => 'Carlos Rodríguez',
            'position' => 'Desarrollador de Software',
            'image' => null,
        ]);

        PLPerson::create([
            'name' => 'Ana Martínez',
            'position' => 'Especialista en Marketing',
            'image' => null,
        ]);

        PLPerson::create([
            'name' => 'Luis Fernández',
            'position' => 'Diseñador Gráfico',
            'image' => null,
        ]);

        PLPerson::create([
            'name' => 'Sofía López',
            'position' => 'Coordinadora de Eventos',
            'image' => null,
        ]);

        PLPerson::create([
            'name' => 'Miguel Torres',
            'position' => 'Consultor de Negocios',
            'image' => null,
        ]);

        PLPerson::create([
            'name' => 'Laura Sánchez',
            'position' => 'Especialista en Recursos Humanos',
            'image' => null,
        ]);

        PLPerson::create([
            'name' => 'Diego Ramírez',
            'position' => 'Ingeniero de Soporte Técnico',
            'image' => null,
        ]);
    }
}
