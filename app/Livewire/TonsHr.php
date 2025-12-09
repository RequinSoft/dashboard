<?php

namespace App\Livewire;

use Livewire\Component;


class TonsHr extends Component
{
    public $tonsHr;
    public $molino;

    public function mount()
    {
        $this->getData();
    }

    public function getData()
    {
        $this->tonsHr = 150; // Aquí deberías obtener el valor real de tons/hr desde tu fuente de datos

        if($this->tonsHr <= 0){
            $this->molino = "molino_rojo.svg";
        } else{
            $this->molino = "molino_verde.svg";
        }
    }

    public function render()
    {
        $this->getData();
        return view('livewire.tons-hr');
    }
}
