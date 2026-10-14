@extends('layouts.template_admin')

@section('title', 'Administración')

@section('content')
<section class="mining-admin-intro">
    <div>
        <p class="mining-eyebrow">Panel de administración</p>
        <h2>Gestiona tu operación</h2>
        <p>Accede a los recursos y planes que respaldan la operación de la mina.</p>
    </div>
    <a href="{{ route('index') }}" class="btn btn-primary">
        <span class="fas fa-chart-line me-2" aria-hidden="true"></span>Ver dashboard
    </a>
</section>

<div class="row g-3 mining-admin-grid">
    @foreach ([
        ['equipos.index', 'fa-truck-loading', 'Equipos', 'Administra la flota y el estado de los equipos de mina.', 'Recursos'],
        ['barrenacion.index', 'fa-hard-hat', 'Barrenación', 'Consulta y actualiza los planes y registros de barrenación.', 'Planeación'],
        ['molienda.index', 'fa-industry', 'Molienda', 'Gestiona el plan de producción y los registros por turno.', 'Producción'],
        ['energia.index', 'fa-bolt', 'Energía', 'Configura el medidor principal y los parámetros de demanda.', 'Servicios'],
        ['pi.index', 'fa-network-wired', 'Integración PI', 'Administra la conexión al servidor y los tags de proceso.', 'Sistemas'],
        ['pl-people.index', 'fa-user-shield', 'Prácticas de liderazgo', 'Gestiona el personal y el seguimiento de liderazgo.', 'Personas'],
        ['usuarios.index', 'fa-users', 'Usuarios', 'Administra los usuarios y sus roles de acceso.', 'Accesos'],
        ['ldap.index', 'fa-address-book', 'Directorio LDAP', 'Configura la integración con el directorio corporativo.', 'Sistemas'],
        ['molienda.configuracion', 'fa-cogs', 'Configuración de molienda', 'Define el periodo de visualización de los indicadores.', 'Configuración'],
    ] as [$route, $icon, $title, $description, $category])
        <div class="col-md-6 col-xxl-4">
            <a class="card mining-module" href="{{ route($route) }}">
                <div class="card-body">
                    <div class="mining-module-top">
                        <span class="mining-module-icon"><span class="fas {{ $icon }}" aria-hidden="true"></span></span>
                        <span class="mining-module-category">{{ $category }}</span>
                    </div>
                    <h3>{{ $title }}</h3>
                    <p>{{ $description }}</p>
                    <span class="mining-module-action">Administrar <span class="fas fa-arrow-right" aria-hidden="true"></span></span>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
