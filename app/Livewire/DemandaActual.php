<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\DemandaActual as DemandaActualModel;

class DemandaActual extends Component
{
    public $demandaActual;
    public $demandaColor;

    public function mount()
    {
        $this->updatedFactorPotencia();
    }

    public function updatedFactorPotencia()
    {
        $demanda = DemandaActualModel::find(1);
        $this->demandaActual = $demanda->kw;

        if($this->demandaActual < 18000){
            $this->demandaColor = 'blue';
        } elseif($this->demandaActual >= 18001 && $this->demandaActual < 21000){
            $this->demandaColor = 'orange';
        } else {
            $this->demandaColor = 'red';
        }
    }

    public function render()
    {
        $this->updatedFactorPotencia();
        return view('livewire.demanda-actual');
    }
}
