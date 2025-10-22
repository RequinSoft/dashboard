<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Conversion;

class Conversiones extends Component
{
    public $conversiones;

    public function mount()
    {
        $this->actualizarConversiones();
    }

    public function actualizarConversiones()
    {
        $this->conversiones = Conversion::find(1);
    }

    public function render()
    {
        $this->actualizarConversiones();
        return view('livewire.conversiones');
    }
}
