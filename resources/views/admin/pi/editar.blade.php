@extends('layouts.template_admin')

@section('title', 'Administración - PI')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar PI</h5>
    </div>
    <div class="card-body bg-light">
        <form action="{{ route('pi.update') }}" method="POST">
            @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
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
                        <input type="hidden" name="id" value="{{ $data->id }}">
                    </div>
                </div>
                
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Ip PI</label>
                    <input class="form-control" id="ip_pi" name="ip_pi" type="text" value="{{ $data->ip_pi ? $data->ip_pi : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Puerto PI</label>
                    <input class="form-control" id="port_pi" name="port_pi" type="text" value="{{ $data->port_pi ? $data->port_pi : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Ip AF</label>
                    <input class="form-control" id="ip_af" name="ip_af" type="text" value="{{ $data->ip_af ? $data->ip_af : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Puerto AF</label>
                    <input class="form-control" id="port_af" name="port_af" type="text" value="{{ $data->port_af ? $data->port_af : '' }}" />
                </div>
                          
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('admin.index') }}" class="btn btn-danger btn-user btn-block">
                        Regresar
                    </a>
                </div> 
                <div class="col-6 mt-2">
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Actualizar
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