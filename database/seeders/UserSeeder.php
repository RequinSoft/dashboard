<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        User::factory()->create([
            'name' => 'sa',
            'user' => 'sa',
            'authen' => 1,
            'email' => 'sa@gmail.com',
            'password' => bcrypt('54rtr3007'),
        ]);

        User::factory()->create([
            'name' => 'admin',
            'user' => 'admin',
            'authen' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
