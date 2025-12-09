<?php
// Livewire Component: MoliendaChart.php
// Ubicación: app/Livewire/MoliendaChart.php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Molienda;
use App\Models\MoliendaConfiguracion;
use Carbon\Carbon;

class MoliendaChart extends Component
{
    public array $dias = [];
    public array $planMolienda = [];
    public array $realMolienda = [];

    public function mount()
    {
        $this->actualizarData();
    }

    public function actualizarData()
    {
        // LIMPIAR ARRAYS
        $this->dias = [];
        $this->planMolienda = [];
        $this->realMolienda = [];

        $diaAConsiderar = MoliendaConfiguracion::first()->dias;

        for ($i = $diaAConsiderar - 1; $i >= 0; $i--) {
            $this->dias[] = Carbon::now()->subDays($i+1)->format('d');
        }
        $principio = Carbon::now()->subDays($diaAConsiderar - 1)->startOfDay();
        $fin = Carbon::now()->endOfDay();

        $this->planMolienda = Molienda::query()
            ->whereBetween('fecha', [$principio, $fin])
            ->pluck('plan')
            ->toArray();
            
        $this->realMolienda = Molienda::query()
            ->whereBetween('fecha', [$principio, $fin])
            ->selectRaw('DATE(fecha) as dia, SUM(primer_turno + segundo_turno) as suma')
            ->groupBy('dia')
            ->orderBy('dia')
            ->pluck('suma')
            ->map(function ($value) {
                return $value === null ? 0 : $value;
            })
            ->toArray();

        // 🔥 Dispara el evento para el JS externo
        $this->dispatch('updateMoliendaChart', [
            'dias' => $this->dias,
            'planMolienda' => $this->planMolienda,
            'realMolienda' => $this->realMolienda
        ]);
    }

    public function render()
    {
        return view('livewire.molienda-chart');
    }
}
?>

