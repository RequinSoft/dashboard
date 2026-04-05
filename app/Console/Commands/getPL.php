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
        $pastMonth = Carbon::now()->subMonth()->month;
        $currentYear = Carbon::now()->year;

        $monthName = Carbon::createFromDate($currentYear, $currentMonth, 1)->locale('es')->monthName;
        $pastMonthName = Carbon::createFromDate($currentYear, $pastMonth, 1)->locale('es')->monthName;
        //print("Nombre del Mes Actual: $monthName\n");
        //print("Nombre del Mes Anterior: $pastMonthName\n");
        
        $avgMonth = AVGMes::where('MES', $pastMonthName)
            ->where('ANIO', $currentYear);

        print("Obteniendo datos para el mes: $currentMonth, año: $currentYear\n");

        print_r($avgMonth->get()->toArray());
        
    }
}
