@extends('layouts.template_admin')

@section('title', 'Usuarios')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Añadir Usuario</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
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
<!--
                <div class="col-sm-6 mb-3">
                </div>

                <div class="col-sm-6 mb-3 ">
                    <label class="form-label" for="event-venue">Activo</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" {{ $data->status ? 'checked' : '' }}>
                    </div>
                </div>
-->                

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Usuario</label>
                    <input class="form-control" id="user" name="user" type="text" />
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Nombre Completo</label>
                    <input class="form-control" id="name" name="name" type="text"    />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Set Point</label>
                    <input class="form-control" id="setpoint" name="setpoint" type="text" value="{{ $data->setpoint ? $data->setpoint : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Nombre</label>
                    <input class="form-control" id="description" name="name" type="text" value="{{ $data->name ? $data->name : '' }}" />
                </div>
                          
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('admin.index') }}" class="btn btn-danger btn-user btn-block">
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