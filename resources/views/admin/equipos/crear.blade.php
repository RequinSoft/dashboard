@extends('layouts.template_admin')

@section('title', 'Equipos - Crear')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Añadir Equipo</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
                        <label class="form-label" for="event-venue">Equipo</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" />
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Tipo</label>
                        <select class="form-select" id="tipo" name="tipo">
                            <option value="">Seleccione un tipo</option>
                            <option value="Perforadora" {{ old('tipo') == 'Perforadora' ? 'selected' : '' }}>Perforadora</option>
                            <option value="Pala" {{ old('tipo') == 'Pala' ? 'selected' : '' }}>Pala</option>
                            <option value="Camion" {{ old('tipo') == 'Camión' ? 'selected' : '' }}>Camión</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Estado</label>
                        <input class="form-control" id="activo" name="activo" type="text" value="Activo" readonly />
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