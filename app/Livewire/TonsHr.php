<?php

namespace App\Livewire;

use Livewire\Component;

class TonsHr extends Component
{
    public $tonsHr = 0;

    public function render()
    {
        return view('livewire.tons-hr');
    }
}
