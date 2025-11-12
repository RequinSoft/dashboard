@extends('layouts.template_admin')

@section('title', 'LDAP')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar LDAP</h5>
    </div>
    <div class="card-body bg-light">
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
                        <input disabled class="form-check-input" type="checkbox" role="switch" id="status" name="status" {{ $data->status ? 'checked' : '' }}>
                    </div>
                </div>
                
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Ip</label>
                    <input disabled class="form-control" id="ip" name="ip" type="text" value="{{ $data->ip ? $data->ip : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Puerto</label>
                    <input disabled class="form-control" id="port" name="port" type="text" value="{{ $data->port ? $data->port : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Dominio</label>
                    <input disabled class="form-control" id="domain" name="domain" type="text" value="{{ $data->domain ? $data->domain : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Versión</label>
                    <input disabled class="form-control" id="version" name="version" type="text" value="{{ $data->version ? $data->version : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Usuario</label>
                    <input disabled class="form-control" id="user" name="user" type="text" value="{{ $data->user ? $data->user : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Contraseña</label>
                    <input disabled class="form-control" id="password" name="password" type="text" value="{{ $data->password ? $data->password : '' }}" />
                </div>


                          
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('admin.index') }}" class="btn btn-danger btn-user btn-block">
                        Regresar
                    </a>
                </div> 
                <div class="col-6 mt-2">
                    <a href="{{ route('ldap.editar') }}" class="btn btn-primary btn-user btn-block">
                        Editar
                    </a>
                </div>
            </div>
    </div>
</div>



    </div>
</div>
<!-- Presentación del Dashboard Juanicipio -->
@endsection