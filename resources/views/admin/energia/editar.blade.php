@extends('layouts.template_admin')

@section('title', 'Administración - Energía')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar Set Point</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('energia.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @error('ip')
                        <small class="text-danger d-block mb-2">{{ $message }}</small>
                    @enderror
                    @error('port')
                        <small class="text-danger d-block mb-2">{{ $message }}</small>
                    @enderror
                    @error('setpoint')
                        <small class="text-danger d-block mb-2">{{ $message }}</small>
                    @enderror  
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div> 

                <div class="col-sm-6 mb-3">
                </div>

                <div class="col-sm-6 mb-3 ">
                    <label class="form-label" for="event-venue">Activo</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" {{ $data->status ? 'checked' : '' }}>
                    </div>
                </div>
                
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Ip</label>
                    <input class="form-control" id="ip" name="ip" type="text" value="{{ $data->ip ? $data->ip : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Puerto</label>
                    <input class="form-control" id="port" name="port" type="text" value="{{ $data->port ? $data->port : '' }}" />
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