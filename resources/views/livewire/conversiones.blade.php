
<!-- Conversiones -->
<div class="col-lg-2 border-lg-end border-bottom border-lg-0 pb-3 pb-lg-0">
    <!-- Dolar -->
    <div class="d-flex flex-between-center mb-3">
        <div class="d-flex align-items-center">
            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-primary">
                <span class="fs--2 far fa-money-bill-alt text-primary"></span>
            </div>
            <h6 class="mb-0">Dolar</h6>
        </div>
    </div>
    <div class="text-end">
        <div class="d-flex">
            <p class="font-sans-serif lh-1 mb-1 fs-1 pe-2">$ {{ number_format($conversiones->usd, 2) }}</p>
        </div>
    </div>
    <!-- Dolar -->
    
    <!-- Oro -->
    <div class="d-flex flex-between-center mb-3">
        <div class="d-flex align-items-center">
            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-primary">
                <span class="fs--2 fas fa-coins text-primary"></span>
            </div>
            <h6 class="mb-0">Oro</h6>
        </div>
    </div>
    <div class="text-end">
        <div class="d-flex">
            <p class="font-sans-serif lh-1 mb-1 fs-1 pe-2">$ {{ number_format($conversiones->au, 2) }}</p>
        </div>
    </div>
    <!-- Oro -->                        
    
    <!-- Plata -->
    <div class="d-flex flex-between-center mb-3">
        <div class="d-flex align-items-center">
            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-primary">
                <span class="fs--2 fas fa-coins text-primary"></span>
            </div>
            <h6 class="mb-0">Plata</h6>
        </div>
    </div>
    <div class="text-end">
        <div class="d-flex">
            <p class="font-sans-serif lh-1 mb-1 fs-1 pe-2">$ {{ number_format($conversiones->ag, 2) }}</p>
        </div>
    </div>
    <!-- Plata -->

    <!-- Última Actualización -->
    <div class="fs--2 fw-semi-bold text-center">
        <div class="text-warning">
            Actualizado
        </div>
        <div class="text-primary">
            {{ \Carbon\Carbon::parse($conversiones->updated_at)->locale('es')->isoFormat('DD [de] MMMM [de] YYYY, h:mm:ss A') }}
        </div>
    </div>
    <!-- Última Actualización -->

</div>                    
<!-- Conversiones -->