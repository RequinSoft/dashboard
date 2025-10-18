<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\DemandaActual as DemandaActualModel;
use App\Models\ConfigKw;

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

        $configKw = ConfigKw::query()
            ->where('status', 1)
            ->first();

        if($configKw->status == 1){
            if($this->demandaActual < $configKw->setpoint){
                $this->demandaColor = 'blue';
            } else {
                $this->demandaColor = 'red';
            }
        }
    }

    public function render()
    {
        $this->updatedFactorPotencia();
        return view('livewire.demanda-actual');
    }
}
