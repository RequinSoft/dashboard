<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DemandaAlarma as DemandaAlarmaModel;

class DemandaAlarma extends Component
{
    public $tiempo;

    public function mount()
    {
        $this->updatedDemandaAlarma(); // Valor inicial
    }

    public function updatedDemandaAlarma(){

        $demanda = DemandaAlarmaModel::query()->where('activa', 1)->get();
        $existe = $demanda->count();

        if($existe == 0){
            $this->tiempo = '';
        } else {
            $inicio = $demanda[0]->created_at;
            $fin = $demanda[0]->updated_at;

            $tiempo = $fin->diff($inicio);
            $this->tiempo = $tiempo->format('%H:%I:%S');
        }
    }

    public function render()
    {
        $this->updatedDemandaAlarma();
        return view('livewire.demanda-alarma');
    }
}
