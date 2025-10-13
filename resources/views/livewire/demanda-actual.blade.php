<div wire:poll.5s class="text-end">
    <div class="d-flex">
        <p style="color: {{ $demandaColor }}" class="font-sans-serif lh-1 mb-1 fs-4 pe-2">
            <!-- Demanda al iniciar la página -->
            {{ number_format($demandaActual, 0) }} kW
        </p>
    </div>                            
</div>