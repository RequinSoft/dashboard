<?php

namespace App\Livewire;

use Livewire\Component;

use Carbon\Carbon;

class FechaActual extends Component
{
    public $fecha;

    public function mount()
    {
        $this->updatedFecha();
    }

    public function updatedFecha()
    {
        $this->fecha = Carbon::now()->format('d/m/Y H:i:s');
    }

    public function render()
    {
        $this->updatedFecha();
        return view('livewire.fecha-actual');
    }
}
