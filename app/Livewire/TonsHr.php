<?php

namespace App\Livewire;

use Livewire\Component;


class TonsHr extends Component
{
    public $getData = [];

    public function mount()
    {
        $this->getData();
    }

    public function getData()
    {
        $getData = [];
        // Lógica para obtener los datos de tons/hr y molino
        
        $this->getData = $getData;
    }

    public function render()
    {
        $this->getData();
        return view('livewire.tons-hr');
    }
}
