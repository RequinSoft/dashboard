<header class="mining-masthead">
    <div>
        <p class="mining-eyebrow">{{ $administration ? 'Gestión y configuración' : 'Centro de control minero' }}</p>
        <h1>{{ $empresa ?: 'Unidad minera' }}</h1>
        <p class="mining-masthead-description">{{ $administration ? 'Administración de recursos, sistemas y planes operativos.' : 'Visión integral de producción, energía y personal.' }}</p>
    </div>
    <div class="mining-masthead-tools">
        <div class="mining-date">
            <span class="far fa-calendar-alt" aria-hidden="true"></span>
            @livewire('fecha-actual')
        </div>
        @auth
            <div class="dropdown">
                <button class="mining-account dropdown-toggle" type="button" id="miningAccount"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mining-avatar"><span class="fas fa-user" aria-hidden="true"></span></span>
                    <span>{{ auth()->user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="miningAccount">
                    <li><a class="dropdown-item" href="{{ route('index') }}">Ver operación</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.index') }}">Administración</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
                </ul>
            </div>
        @endauth
    </div>
</header>
