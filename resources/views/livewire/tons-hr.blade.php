<div wire:poll.5s class="col-xxl-3 text-center mining-mill">
    <p class="mining-eyebrow">Ritmo de alimentación</p>
    <h3 id="obtenerRitmo" class="{{ $tonsHr <= 0 ? 'text-danger' : 'text-primary' }}">
        {{ $tonsHr }} tons/hr
    </h3>

    <x-molino :running="$tonsHr > 0" :svg-id="'molino-' . $this->getId()" />
</div>