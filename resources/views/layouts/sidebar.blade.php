<div class="content mining-content">
    <nav class="mining-topnav" aria-label="Navegación principal">
        <a class="mining-brand" href="{{ route('index') }}">
            <span class="mining-brand-icon"><span class="fas fa-mountain" aria-hidden="true"></span></span>
            <span>MINA<span class="mining-brand-subtitle">Gestión operativa</span></span>
        </a>
        <div class="mining-topnav-links">
            <a href="{{ route('index') }}" class="active" aria-current="page">Operación</a>
            @auth
                <a href="{{ route('admin.index') }}">Administración</a>
            @else
                <a href="{{ route('loginIndex') }}">Ingresar <span class="fas fa-arrow-right ms-1" aria-hidden="true"></span></a>
            @endauth
        </div>
    </nav>
    @include('layouts.mining-masthead', ['administration' => false])
