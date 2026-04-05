<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\PL;
use App\Models\AVGMes;
use App\Models\PLPerson;

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

        $plPersons = PLPerson::all()->sortBy('name')->pluck('name')->toArray();
        foreach($plPersons as $person){
            print("Persona en PL: $person\n");
        }
        print("Total de personas en PL: " . count($plPersons) . "\n");
        
        $avgMonth = AVGMes::query()
            ->whereIn('PERSONA', $plPersons)
            ->where('MES', $pastMonthName)
            ->where('ANIO', $currentYear)
            ->sortBy('PERSONA')
            ->get();

        print("Obteniendo datos para el mes: $pastMonthName, año: $currentYear\n");

        foreach($avgMonth as $avg){
            print("Persona: $avg->PERSONA, Porcentaje Total: $avg->PORCENTAJE_TOTAL\n");
        }
        print("Total de registros obtenidos: " . count($avgMonth) . "\n");
        

    }
}
