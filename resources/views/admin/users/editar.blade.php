@extends('layouts.template_admin')

@section('title', 'Administración - Usuarios')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Usuarios</h5>
    </div>
</div>

<div id="tableExample2" data-list='{"valueNames":["usuario","nombre","rol", "grupo", "auten", "email", "custom"],"page":25,"pagination":true}'>
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped fs--2 mb-0">
        <thead class="bg-500 text-900">
          <tr>
            <th class="text-center sort" >N°</th>
            <th class="text-center sort" data-sort="img">Avatar</th>
            <th class="text-center sort" data-sort="usuario">Usuario</th>
            <th class="text-center sort" data-sort="nombre">Nombre</th>
            <th class="text-center sort" data-sort="rol">Rol</th>
            <th class="text-center sort" data-sort="grupo">Grupo</th>
            <th class="text-center sort" data-sort="auten">Autenticación</th>
            <th class="text-center sort" data-sort="email">Email</th>
            <th class="text-center sort" data-sort="custom">Custom</th>
            <th class="text-center sort" data-sort="custom">Estado</th>
            <th class="text-center sort" data-sort="acciones">Acciones</th>
          </tr>
        </thead>
        <tbody class="list">
            @php
                $n = 1;
                $color = 'green';
            @endphp
            @foreach ($usuarios as $row)
            <tr>
                @php
                    if($row->status == 'inactivo'){
                        $color = 'red';
                    }if($row->status == 'activo'){
                        $color = 'green';
                    }
                @endphp
                <td>{{ $n }}</td>
                <td class="img text-center">
                    @if($row->img == null)
                        <img src="{{ asset('assets/img/users/admin.png') }}" class="img-fluid rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                    @else
                        <img src="{{ asset('avatars/'.$row->img) }}"  class="img-fluid rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                    @endif
                </td>
                <td class="usuario">{{ $row->user }}</td>
                <td class="nombre">{{ $row->name }}</td>
                <td class="rol"></td>
                <td class="grupo"></td>
                @if ($row->auten == 1)
                    <td class="text-center">Local</td>
                @else
                    <td class="text-center">LDAP</td>
                @endif
                <td class="email">{{ $row->email }}</td>
                <td class="custom">{{ $row->comment1 }}</td>
                <td class="text-center estatus">
                    <p style="color:{{$color}}">
                        {{ $row->status }}
                    </p>
                </td>
                <td class="text-center">
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