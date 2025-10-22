<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\DemandaActual as DemandaActualModel;
use App\Models\ConfigKw;

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

        $configKw = ConfigKw::query()
            ->where('id', 1)
            ->first();

        if($configKw->status == 1){
            $this->factorPotencia = $demanda->factor_potencia.' %';
        }else{
            $this->factorPotencia = '';
        }

    }

    public function render()
    {
        $this->updatedFactorPotencia();
        return view('livewire.factor-potencia');
    }
}
