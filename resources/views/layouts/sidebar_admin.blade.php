<nav class="navbar navbar-light navbar-vertical navbar-expand-xl mining-sidebar" aria-label="Administración minera">
    <div class="mining-sidebar-brand">
        <a class="mining-brand" href="{{ route('index') }}">
            <span class="mining-brand-icon"><span class="fas fa-mountain" aria-hidden="true"></span></span>
            <span>MINA<span class="mining-brand-subtitle">Gestión operativa</span></span>
        </a>
        <button class="navbar-toggler mining-menu-toggle" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse"
            aria-expanded="false" aria-label="Abrir menú de administración">
            <span class="fas fa-bars" aria-hidden="true"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}"
                        @if(request()->routeIs('admin.index')) aria-current="page" @endif>
                        <span class="nav-link-icon"><span class="fas fa-th-large" aria-hidden="true"></span></span>
                        <span class="nav-link-text">Resumen</span>
                    </a>
                </li>
                <li class="mining-nav-label">Recursos y sistemas</li>
                @foreach ([
                    ['equipos.index', 'equipos.*', 'fa-truck-loading', 'Equipos'],
                    ['energia.index', 'energia.*', 'fa-bolt', 'Energía'],
                    ['ldap.index', 'ldap.*', 'fa-address-book', 'Directorio LDAP'],
                    ['pi.index', 'pi.index,pi.editar,pi.update', 'fa-network-wired', 'Servidor PI'],
                    ['pi.tags', 'pi.tags*', 'fa-tags', 'Tags de proceso'],
                    ['pl-people.index', 'pl-people.*,pl-person.*', 'fa-user-shield', 'Prácticas de liderazgo'],
                    ['molienda.configuracion', 'molienda.configuracion*', 'fa-cogs', 'Configuración de molienda'],
                ] as [$route, $pattern, $icon, $label])
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(...explode(',', $pattern)) ? 'active' : '' }}" href="{{ route($route) }}"
                            @if(request()->routeIs(...explode(',', $pattern))) aria-current="page" @endif>
                            <span class="nav-link-icon"><span class="fas {{ $icon }}" aria-hidden="true"></span></span>
                            <span class="nav-link-text">{{ $label }}</span>
                        </a>
                    </li>
                @endforeach
                <li class="mining-nav-label">Planeación y administración</li>
                @foreach ([
                    ['barrenacion.index', 'barrenacion.*', 'fa-hard-hat', 'Barrenación'],
                    ['molienda.index', 'molienda.index,molienda.editar,molienda.update', 'fa-industry', 'Plan de molienda'],
                    ['usuarios.index', 'usuarios.*', 'fa-users', 'Usuarios'],
                ] as [$route, $pattern, $icon, $label])
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(...explode(',', $pattern)) ? 'active' : '' }}" href="{{ route($route) }}"
                            @if(request()->routeIs(...explode(',', $pattern))) aria-current="page" @endif>
                            <span class="nav-link-icon"><span class="fas {{ $icon }}" aria-hidden="true"></span></span>
                            <span class="nav-link-text">{{ $label }}</span>
                        </a>
                    </li>
                @endforeach
                <li class="mining-nav-label">Centro de control</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">
                        <span class="nav-link-icon"><span class="fas fa-chart-line" aria-hidden="true"></span></span>
                        <span class="nav-link-text">Ver dashboard operativo</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="content mining-content">
    @include('layouts.mining-masthead', ['administration' => true])
