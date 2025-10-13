<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\DemandaActual as DemandaActualModel;

class FactorPotencia extends Component
{
    public $factorPotencia;

    public function mount()
    {
        $this->updatedFactorPotencia();
    }

    public function updatedFactorPotencia()
    {
        $demanda = DemandaActualModel::find(1);
        $this->factorPotencia = $demanda->factor_potencia;
    }

    public function render()
    {
        $this->updatedFactorPotencia();
        return view('livewire.factor-potencia');
    }
}
