<div wire:poll.5s class="col-xxl-2 text-center">
    <h3 id="obtenerRitmo" class="{{ $tonsHr <= 0 ? 'text-danger' : 'text-primary' }}">
        {{ $tonsHr }} tons/hr
    </h3>

    <x-molino :running="$tonsHr > 0" :svg-id="'molino-' . $this->getId()" />
</div>