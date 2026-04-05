<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\PL;
use App\Models\AVGMes;

class getPL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-p-l';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates the average PL for the current month and updates the AVGMes table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $avgMonth = AVGMes::where('MES', $currentMonth)
            ->where('ANIO', $currentYear);

        print("Calculando el promedio de PL para el mes: $currentMonth, año: $currentYear\n");

        foreach ($avgMonth as $avg) {
            print("Calculando para la persona: {$avg}\n");
        }
        
    }
}
