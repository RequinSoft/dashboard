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

                <div class="col-sm-2">
                    <div class="avatar avatar-6xl position-relative">
                        <img id="preview" class="img-thumbnail shadow-sm cursor-pointer" 
                            src="{{ $equipo->image ? asset('avatars/avatars/'.$equipo->image) : asset('assets/img/team/avatar.png') }}" 
                            width="200" alt="Company logo" 
                            onclick="document.getElementById('image').click()"
                            style="cursor: pointer;" />
                        
                        <div class="mt-3">
                            <input type="file" class="form-control d-none" id="image" name="image" 
                                accept="image/*" onchange="previewImage(this)"/>
                        </div>
                    </div>
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
                            <option value="Sensor" {{ $equipo->tipo == 'Perforadora' ? 'selected' : '' }}>Perforadora</option>
                            <option value="Bomba" {{ $equipo->tipo == 'Pala' ? 'selected' : '' }}>Pala</option>
                            <option value="Camion" {{ $equipo->tipo == 'Camion' ? 'selected' : '' }}>Camión</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Estado</label>
                        <input class="form-control" id="status" name="status" type="text" value="Activo" readonly />
                    </div>

                </div>
                          
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('equipos.index') }}" class="btn btn-danger btn-user btn-block">
                        Regresar
                    </a>
                </div> 
                <div class="col-6 mt-2">
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