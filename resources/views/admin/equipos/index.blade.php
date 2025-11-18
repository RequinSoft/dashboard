@extends('layouts.template_admin')

@section('title', 'Administración - Equipos')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <div class="col-sm-12 text-end mb-2">
            <div class="btn-group" role="group" aria-label="Acciones de Equipos">
                <a href="{{ route('equipos.crear') }}" class="btn btn-primary" title="Agregar Equipo">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif

@if (session('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert" id="info-message">
    {{ session('info') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif

@if (session('status'))
<div class="alert alert-secondary alert-dismissible fade show" role="alert" id="status-message">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif

<div id="tableExample2" data-list='{"valueNames":["usuario","nombre","rol", "grupo", "auten", "email", "custom"],"page":25,"pagination":true}'>
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped fs--2 mb-0">
        <thead class="bg-500 text-900">
          <tr>
            <th class="text-center sort" >N°</th>
            <th class="text-center sort" data-sort="image">Equipo</th>
            <th class="text-center sort" data-sort="tipo">Tipo</th>
            <th class="text-center sort" data-sort="activo">Estado</th>
            <th class="text-center sort" data-sort="acciones">Acciones</th>
          </tr>
        </thead>
        <tbody class="list">
            @php
                $n = 1;
                $color = 'green';
            @endphp
            @foreach ($equipos as $row)
            <tr>
                @php
                    if($row->activo){
                        $color = 'green';
                    }else {
                        $color = 'red';
                    }
                @endphp
                <td>{{ $n }}</td>
                <td class="equipo">{{ $row->name }}</td>
                <td class="nombre">{{ $row->tipo }}</td>
                <td class="text-center estatus">
                    <p style="color:{{$color}}">
                        {{ $row->activo ? 'Activo' : 'Inactivo' }}
                    </p>
                </td>
                <td class="text-center">
                    <a href="{{ route('equipos.editar', $row->id) }}" class="btn btn-sm btn-primary" title="Editar Equipo">
                        <span class="fas fa-edit" aria-hidden="true"></span>
                        <span class="visually-hidden">Editar</span>
                    </a>
                    @if ($row->name != 'admin' && $row->name != 'sa')
                        @if ($row->activo)
                            <a href="{{ route('equipos.eliminar', $row->id) }}" class="btn btn-sm btn-danger" title="Eliminar Equipo">
                                <span class="fas fa-trash" aria-hidden="true"></span>
                                <span class="visually-hidden">Eliminar</span>
                            </a>
                        @else
                            <a href="{{ route('equipos.activar', $row->id) }}" class="btn btn-sm btn-success" title="Activar Equipo">
                                <span class="fas fa-check" aria-hidden="true"></span>
                                <span class="visually-hidden">Activar</span>
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
            @php
                $n++;
            @endphp
            @endforeach
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
      <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
      <ul class="pagination mb-0"></ul>
      <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
    </div>
</div>


    </div>
</div>
<!-- Presentación del Dashboard Juanicipio -->
@endsection
@section('script')
<script>
    // Ocultar el mensaje de éxito después de 5 segundos
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 5000); // 5000 milisegundos = 5 segundos
</script>
<script>
    // Ocultar el mensaje de error después de 5 segundos
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 5000); // 5000 milisegundos = 5 segundos
</script>
@endsection