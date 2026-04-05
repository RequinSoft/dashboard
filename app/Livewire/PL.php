<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\PL as PLModel;

class PL extends Component
{
    public $plAvg;

    public function render()
    {
        $this->plAvg = $this->calcularPLAvg();
        return view('livewire.p-l');
    }

    public function mount()
    {
        // Aquí puedes cargar los datos necesarios para el componente, por ejemplo:
        $this->plAvg = $this->calcularPLAvg();
    }

    public function calcularPLAvg()
    {
        // Lógica para calcular el PL promedio o el valor que deseas mostrar
        // Por ejemplo, podrías obtener los datos de la base de datos y calcular el promedio
        // $plValues = PL::all()->pluck('pl');
        // return $plValues->avg();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $plValues = PLModel::where('year', $currentYear)
            ->where('month', $currentMonth)
            ->pluck('pl');

        return $plValues->avg() ?? 0; // Devuelve el promedio o 0 si no hay datos   
    }
}
