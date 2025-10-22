<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
  <script>
    var navbarStyle = localStorage.getItem("navbarStyle");
    if (navbarStyle && navbarStyle !== 'transparent') {
      document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
    }
  </script>
  <div class="d-flex align-items-center">
    <div class="toggle-icon-wrapper">

      <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

    </div><a class="navbar-brand" href="#">
      <div class="d-flex align-items-center py-3">
          <span class="font-sans-serif">
            Menú
          </span>                
      </div>
    </a>
  </div>

  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
      <div class="navbar-vertical-content scrollbar">
        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">


            <!-- parent pages--><a class="nav-link" href="{{ route('admin.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                  <span class="fas fa-home">
                  </span>
                </span>
                <span class="nav-link-text ps-1">Home</span>
              </div>
            </a>

          <li class="nav-item">
            <!-- label-->
            <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
              <div class="col-auto navbar-vertical-label">Configuración
              </div>
              <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider" />
              </div>
            </div>

            <!-- parent pages--><a class="nav-link" href="" role="button" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                  <span class="fas fa-globe">
                  </span>
                </span>
                <span class="nav-link-text ps-1">Molienda</span>
              </div>
            </a>

            <!-- parent pages--><a class="nav-link" href="" role="button" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                  <span class="fas fa-circle">
                  </span>
                </span>
                  <span class="nav-link-text ps-1">Plan de Barrenacion</span>
              </div>
            </a>

            <a class="nav-link" href="{{ route('energia.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                  <span class="fa fa-bolt">
                  </span>
                </span>
                  <span class="nav-link-text ps-1">Energía</span>
              </div>
            </a>

            <!-- parent pages--><a class="nav-link" href="{{ route('usuarios.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                  <span class="fas fa-users">
                  </span>
                </span>
                  <span class="nav-link-text ps-1">Usuarios</span>
              </div>
            </a>
          </li>
      </ul>
    </div>
  </div>
          
</nav>

  <div class="content">
      <!-- Menú dispositivos -->
      <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

          <a class="navbar-brand me-1 me-sm-3" >
          </a>
          <ul class="navbar-nav align-items-center d-none d-lg-block">
          <li class="nav-item">

          </li>
          </ul>
      </nav>
      <!-- Termina Menú dispositivos -->


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