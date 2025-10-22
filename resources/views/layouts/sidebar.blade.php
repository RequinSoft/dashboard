  <div class="content">
      <!-- Menú dispositivos -->
      <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

      </nav>
      <!-- Termina Menú dispositivos -->

@if(Auth::check())
<!-- Presentación del Dashboard Juanicipio -->
<div class="row mb-3">
    <div class="col">
        <div class="card bg-100 shadow-none border">
            <div class="row gx-0 flex-between-center">
                <div class="col-sm-auto d-flex align-items-center">
                    <img class="ms-n2" src="{{asset('assets/img/illustrations/crm-bar-chart.png')}}" alt="" width="90" />
                    <div>
                        <h6 class="text-primary fs--1 mb-0">Dashboard Operativo</h6>
                        <h4 class="text-primary fw-bold mb-0">{{$empresa}} <span class="text-info fw-medium"></span></h4>
                    </div>
                </div>
                
                <div class="col-md-auto p-3">
                    <div class="row align-items-center g-1">
                        @livewire('fecha-actual')
                        
                        <div class="vr ms-3 me-3">
                        </div>
                        <div class="col-auto pr-3">
                            <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                                        {{ auth()->user()->name }}
                                <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-xl">
                                        <img class="rounded-circle" src="{{ asset('assets/img/icons/user1 h 256.png') }}" alt="" /> 
                                    </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">   
                                        <a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a>
                                    </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
@else

<!-- Presentación del Dashboard Juanicipio -->
<div class="row mb-3">
    <div class="col">
        <div class="card bg-100 shadow-none border">
            <div class="row gx-0 flex-between-center">
                <div class="col-sm-auto d-flex align-items-center">
                    <img class="ms-n2" src="{{asset('assets/img/illustrations/crm-bar-chart.png')}}" alt="" width="90" >
                    </img>
                    <div>
                        <h6 class="text-primary fs--1 mb-0">Dashboard Operativo</h6>
                        <h4 class="text-primary fw-bold mb-0">{{$empresa}} <span class="text-info fw-medium"></span></h4>
                    </div>
                </div>
                <div class="col-md-auto p-3">
                    <div class="row align-items-center g-3">
                        @livewire('fecha-actual')
                        <div class="col-auto">
                            <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                                <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-xl">
                                        <img class="rounded-circle" src="{{ asset('assets/img/icons/user1 h 256.png') }}" alt="" /> 
                                    </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">   
                                        <a class="dropdown-item" href="{{ route('login') }}">Ingresar</a>
                                    </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Presentación del Dashboard Juanicipio -->
@endif