@extends('layouts.template_admin')

@section('title', 'Usuarios')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Añadir Usuario</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('equipos.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>   

                <div class="col-sm-9 row">
                    <div class="col-sm-4">
                        <input type="hidden" name="id" value="{{ $equipo->id }}">
                        <label class="form-label" for="event-venue">Equipo</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $equipo->name }}" />
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Tipo</label>
                        <select class="form-select" id="tipo" name="tipo">
                            <option value="Perforadora" {{ $equipo->tipo == 'Perforadora' ? 'selected' : '' }}>Perforadora</option>
                            <option value="Pala" {{ $equipo->tipo == 'Pala' ? 'selected' : '' }}>Pala</option>
                            <option value="Camion" {{ $equipo->tipo == 'Camion' ? 'selected' : '' }}>Camión</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Estado</label>
                        <input class="form-control" id="status" name="status" type="text" value="Activo" readonly />
                    </div>

                </div>
                          
                <div class="col-6 mt-3 text-end">
                    <a href="{{ route('equipos.index') }}" class="btn btn-danger btn-user btn-block">
                        Regresar
                    </a>
                </div> 
                <div class="col-6 mt-3">
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



    </div>
</div>
<!-- Presentación del Dashboard Juanicipio -->
@endsection