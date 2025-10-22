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

        $configKw = ConfigKw::query()
            ->where('id', 1)
            ->first();

        if($configKw->status == 1){
            $demanda = number_format($demanda->kw,0);
            $this->demandaActual = $demanda.' Kw';

            if($this->demandaActual < $configKw->setpoint){
                $this->demandaColor = 'blue';
            } else {
                $this->demandaColor = 'red';
            }
        }else if($demanda->mensaje == 'inactivo'){
            $this->demandaActual = '';
        }else if($demanda->mensaje == 'No hay Conexión'){
            $this->demandaActual = 'No hay Conexión';
        }
    }

    public function render()
    {
        $this->updatedFactorPotencia();
        return view('livewire.demanda-actual');
    }
}
