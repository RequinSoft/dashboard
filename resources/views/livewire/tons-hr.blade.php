<div wire:poll.5s class="col-xxl-2 text-center">
    <h3 id="obtenerRitmo" class="{{ $tonsHr <= 0 ? 'text-danger' : 'text-primary' }}">
        {{ $tonsHr }} tons/hr
    </h3>   

    <img src="{{ asset('assets/img/' . $molino) }}"  height="350" width="350" >
</div>