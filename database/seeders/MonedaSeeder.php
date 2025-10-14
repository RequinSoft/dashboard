<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Conversion;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        Conversion::create([
            'usd' => '18.0',
            'au' => '3200',
            'ag' => '20',
        ]);
    }
}
