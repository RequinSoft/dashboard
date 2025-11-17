@extends('layouts.template_admin')

@section('title', 'Administración - Energía')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Configurar Plan de Molienda</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('molienda.configuracion.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @error('plan')
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
                        <input class="form-check-input" type="checkbox" role="switch" id="activo" name="activo" {{ $data->activo ? 'checked' : '' }}>
                    </div>
                </div>
                
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Plan Diario</label>
                    <input class="form-control" id="plan" name="plan" type="text" value="{{ $data->plan ? $data->plan : '' }}" />
                </div>
                <div class="col-sm-6 mb-3">

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