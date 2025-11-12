@extends('layouts.template')

@section('title', 'Principal')

@section('content')
<!-- Primer Marco, Dashboard Juanicipio -->
<div class="row mb-3 g-3">

    <div class="col-lg-12 col-xxl-12">
        
        <!-- Primer tira -->
        <div class="card mb-1">
            <div class="card-body">
                <div class="row">

                @livewire('conversiones')

                <!-- Demanda -->
                <div class="col-lg-3 border-lg-end border-bottom border-lg-0 py-3 py-lg-0">
                    <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                <span class="fs--2 fas fa-bolt text-info"></span>
                            </div>
                            <h6 class="mb-0">Demanda</h6> 
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                <span class="fs--2 fa fa-history text-info"></span>
                            </div>
                            <h6 class="mb-0">                              
                                <a href="" target="#">Histórico</a>
                            </h6> 
                        </div>
                    </div>
                        @livewire('demanda-actual')
                    <div class="text-end">
                            <!-- Simple Espacio -->
                            <hr>                        
                    </div>

                        @livewire('demanda-alarma')

                    <div class="text-end">
                            <!-- Simple Espacio -->
                            <hr>                        
                    </div>

                    <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                <span class="fs--2 fas fa-bolt text-info"></span>
                            </div>
                            <h6 class="mb-0">Factor</h6> 
                        </div>
                        
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    @livewire('factor-potencia')

                </div>
                <!-- Demanda -->

                <!-- Courier -->
                <div class="col-lg-2 border-lg-end border-bottom border-lg-0 py-3 py-lg-0">
                    <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                <span class="fs--2 fas fa-filter text-info"></span>
                            </div>
                            <h6 class="mb-0">Courier</h6>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                <span class="fs--2 fa fa-history text-info"></span>
                            </div>
                            <h6 class="mb-0">                              
                                <a href="" target="#">Histórico</a>
                            </h6> 
                        </div>
                    </div>
                    <div class="d-flex row">
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div class="col-lg-6 font-sans-serif lh-1 mb-1 fs-1 pe-2 pt-1">
                                Au
                            </div>
                            <div id="courierAu" class="col-lg-6 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div>  
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div class="col-lg-6 font-sans-serif lh-1 mb-1 fs-1 pe-2 pt-1">
                                Ag
                            </div>
                            <div id="courierAg" class="col-lg-6 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div> 
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div class="col-lg-6 font-sans-serif lh-1 mb-1 fs-1 pe-2 pt-1">
                                Pb
                            </div>
                            <div id="courierPb" class="col-lg-6 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div>  
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div class="col-lg-6 font-sans-serif lh-1 mb-1 fs-1 pe-2 pt-1">
                                Zn
                            </div>
                            <div id="courierZn" class="col-lg-6 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div>   

                    </div>
                </div>
                <!-- Courier -->

                <!-- Tracking -->
                <div class="col-lg-3 border-lg-end border-bottom border-lg-0 py-3 py-lg-0">
                    <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                <span class="fs--2 far fa-user-circle text-info"></span>
                            </div>
                            <h6 class="mb-0">Personal en Mina</h6>
                        </div>
                        <h4 id="totalPersonal" class="fs-3 fw-normal text-primary text-end">
                            
                        </h4>
                    </div>
                    <div class="d-flex row">
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div id="leyendaRampa1" class="col-lg-8 font-sans-serif lh-1 mb-1 fs-1 pe-2">
                                
                            </div>
                            <div id="rampa1" class="col-lg-4 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div>  
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div id="leyendaRampa2" class="col-lg-8 font-sans-serif lh-1 mb-1 fs-1 pe-2">
                                
                            </div>
                            <div id="rampa2" class="col-lg-4 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div> 
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div id="leyendaRampa3" class="col-lg-8 font-sans-serif lh-1 mb-1 fs-1 pe-2">
                                
                            </div>
                            <div id="rampa3" class="col-lg-4 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div>  
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div id="leyendaTaller1850" class="col-lg-8 font-sans-serif lh-1 mb-1 fs-1 pe-2">
                                
                            </div>
                            <div id="taller1850" class="col-lg-4 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div>
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div id="leyendaCiudadela" class="col-lg-8 font-sans-serif lh-1 mb-1 fs-1 pe-2">
                                
                            </div>
                            <div id="ciudadela" class="col-lg-4 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div>  
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div id="leyendaOtrasAreas" class="col-lg-8 font-sans-serif lh-1 mb-1 fs-1 pe-2">
                                
                            </div>
                            <div id="otrasAreas" class="col-lg-4 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-end">
                                
                            </div>
                        </div>    

                    </div>
                </div>
                <!-- Tracking -->

                <!-- Prácticas de Liderazgo -->
                <div class="col-lg-2 border-lg-end border-bottom border-lg-0 py-3 py-lg-0">
                    <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                <span class="fs--2 far fa-user-circle text-info"></span>
                            </div>
                            <h6 class="mb-0">Prácticas de Liderazgo</h6>
                        </div>
                    </div>
                    <div class="d-flex row">
                        <div class="d-flex">
                            <!-- Valores al iniciar la página -->
                            <div class="col-lg-12 font-sans-serif lh-1 mb-1 fs-1 pe-2 text-center">
                                
                            </div>
                        </div>     

                    </div>
                    <div class="d-flex row">
                        <div class="d-flex">

                            <div id="avgPL" class="col-lg-12 font-sans-serif lh-1 mb-1 fs-2 pe-3 text-center">
                                Prácticas de Liderazgo
                            </div>
                        </div>     

                    </div>

                    <!--                    -->

                    <div class="col ps-0 mb-3">
                        <hr class="mb-0 navbar-vertical-divider" />
                    </div>
                    
                    <div class="d-flex flex-between-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                <span class="fs--2 far fa-user-circle text-info"></span>
                            </div>
                            <h6 class="mb-0"><a href="">Cuadrilleros en Turno</a></h6>
                        </div>
                    </div>
                    <div class="d-flex row">
                        <div class="d-flex">
                            <div id="contarCuadrilleros" class="col-lg-12 font-sans-serif lh-1 mb-1 fs-2 pe-3 text-center">
                                Cuadrilleros en Turno
                            </div>
                        </div>     

                    </div>
                    <!--                      -->
                </div>
                <!-- Prácticas de Liderazgo -->

                </div>
            </div>
        </div>
        <!-- Primer Tira -->

        <!-- Segunda fila -->
        <div class="card col-xxl-12">

            <!-- Leyenda Molienda -->
            <div class="card-header d-flex flex-between-center ps-0 py-0 border-bottom">
                <ul class="nav nav-tabs border-0 flex-nowrap tab-active-caret" id="crm-revenue-chart-tab" role="tablist" data-tab-has-echarts="data-tab-has-echarts">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link py-3 mb-0 active" id="crm-revenue-tab" data-bs-toggle="tab" href="#crm-revenue" role="tab" aria-controls="crm-revenue" aria-selected="true">
                            Molienda
                        </a>
                    </li>
                </ul>

            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-xxl-3">
                        <div class="row g-0 my-3">

                            <div class="col-md-6 col-xxl-12">
                                <div class="border-xxl-bottom border-xxl-200 mb-2">
                                    <h3 id="obtenerRitmo" class="text-primary">
                                        tons/hr
                                    </h3>

                                    <!-- Dona dentro de la gráfica -->
                                    <div id="container_moliendaMensual" class="echart-most-leads my-2" data-echart-responsive="true">


                                    </div>
                                    
                                </div>

                            </div>

                            <div class="col-md-6 col-xxl-12 py-2">
                                <div class="row mx-0">
                                    <div class="col-6 border-end border-bottom py-3">
                                        <h5 id="moliendaTurno1" class="fw-normal text-600"></h5>
                                        <h6 class="text-500 mb-0">Primer Turno</h6>
                                    </div>

                                    <div class="col-6 border-end border-bottom py-3">
                                        <h5 id="moliendaTurno2" class="text-primary fw-normal text-600"></h5>
                                        <h6 class="text-500 mb-0">Segundo Turno</h6>
                                    </div>
                                    <div class="col-12 border-end py-3">
                                        <h5 id='totalMolienda' class="fw-normal text-600 text-center"></h5>
                                        <h6 class="text-500 mb-0 text-center">Total Día</h6>
                                        
                                    </div>
                                    <!--

                                    <div class="col-6 py-3">
                                        <h5 class="fw-normal text-600">$2.3k</h5>
                                        <h6 class="text-500 mb-0">Other</h6>
                                    </div>
                                    -->
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Pie Molienda -->
                    <div class="col-xxl-5">
                        <div class="tab-content">

                            <div  id="container_molienda" aria-labelledby="crm-revenue-tab">
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4">
                        <div class="card-header d-flex flex-between-center ps-0 py-0 border-bottom">
                            <ul class="nav nav-tabs border-0 flex-nowrap tab-active-caret" id="crm-revenue-chart-tab" role="tablist" data-tab-has-echarts="data-tab-has-echarts">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link py-3 mb-0 active" id="crm-revenue-tab" data-bs-toggle="tab" href="#crm-revenue" role="tab" aria-controls="crm-revenue" aria-selected="true">
                                        Molino SAG 
                                        <div class="text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg id="molinoSAG" width="200" height="200" viewBox="0 0 200 200">
                                                    <!-- Cuerpo del molino -->
                                                    <circle cx="100" cy="100" r="60" fill="#9ca3af" stroke="#4b5563" stroke-width="4"/>

                                                    <!-- Interior del molino (representa bolas) -->
                                                    <circle cx="100" cy="100" r="45" fill="#d1d5db"/>
                                                    
                                                    <!-- Ejes y base -->
                                                    <rect x="40" y="160" width="120" height="10" fill="#6b7280"/>
                                                    <rect x="60" y="170" width="80" height="8" fill="#9ca3af"/>

                                                    <!-- Motor lateral -->
                                                    <rect x="150" y="85" width="25" height="30" fill="#4b5563"/>
                                                    <circle cx="180" cy="100" r="10" fill="#6b7280"/>

                                                    <!-- Ejes centrales -->
                                                    <circle cx="100" cy="100" r="6" fill="#1f2937"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>


                </div>                
            </div>

        </div>
        <!-- Segunda fila -->

    </div>

    <!-- Barrenación x Hora -->
    <div class="row g-3">
        <div class="col-xxl-9">
            <div class="card h-150">
    
                <div class="card-header d-flex flex-between-center border-bottom border-200 py-2">
                <h6 class="mb-0">Barrenación x Hora</h6>
                </div>
    
                <div id="container_barrenacion" class="card-body d-flex align-items-center">
                <div class="w-100">
                    <div class="progress overflow-visible rounded-3 font-sans-serif fw-medium fs--1 mt-xxl-auto" style="height: 20px;">
                    
                    </div>
                </div>
                </div>
    
            </div>
        </div>
        <div class="col">
            <div class="row g-3">
                <div class="col-md-4 col-xxl-12">
                    <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center">
                        <div class="col d-md-flex d-lg-block flex-between-center">
                            <h6 class="mb-md-0 mb-lg-2">JU-0001</h6>
                        </div>
                        <div class="col-auto">
                            <h4 class="fs-3 fw-normal"></h4>
                            <p class="text-end font-sans-serif fw-normal lh-1 mb-1 fs-1 pe-2"></p>                            
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 col-xxl-12">
                    <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center">
                        <div class="col d-md-flex d-lg-block flex-between-center">
                            <h6 class="mb-md-0 mb-lg-2">JU-0002</h6>
                        </div>
                        <div class="col-auto">
                            <h4 class="fs-3 fw-normal"></h4>
                            <p class="text-end font-sans-serif fw-normal lh-1 mb-1 fs-1 pe-2"></p>  
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 col-xxl-12">
                    <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center">
                        <div class="col d-md-flex d-lg-block flex-between-center">
                            <h6 class="mb-md-0 mb-lg-2">JU-0003</h6>
                        </div>
                        <div class="col-auto">
                            <h4 class="fs-3 fw-normal"></h4>
                            <p class="text-end font-sans-serif fw-normal lh-1 mb-1 fs-1 pe-2"></p>  
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 col-xxl-12">
                    <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center">
                        <div class="col d-md-flex d-lg-block flex-between-center">
                            <h6 class="mb-md-0 mb-lg-2">Total Diario</h6>
                        </div>
                        <div class="col-auto">
                            <h4 class="fs-3 fw-normal text-primary"></h4>
                            <p class="text-end font-sans-serif fw-normal lh-1 mb-1 fs-1 pe-2"></p>  
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
  
@endsection
