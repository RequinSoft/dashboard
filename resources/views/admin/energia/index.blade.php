@extends('layouts.template_admin')

@section('title', 'Administración - Energía')

@section('content')
<!-- Presentación del Dashboard Juanicipio -->
<div class="row mb-3">
    <div class="col">
        <div class="card bg-100 shadow-none border">
            <div class="row gx-0 flex-between-center">
                <div class="col-sm-auto d-flex align-items-center">
                    <img class="ms-n2" src="{{asset('assets/img/illustrations/crm-bar-chart.png')}}" alt="" width="90" />
                    <div>
                        <h6 class="text-primary fs--1 mb-0">Dashboard Operativo</h6>
                        <h4 class="text-primary fw-bold mb-0">{{$empresa}} <span class="text-info fw-medium"></span></h4>
                    </div>
                </div>
                <div class="col-md-auto p-3">
                    <div class="row align-items-center g-1">
                        @livewire('fecha-actual')
                        <div class="vr ms-3 me-3">

                        </div>
                        <div class="col-auto pr-3">
                            <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                                        {{ auth()->user()->name }}
                                <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-xl">
                                        <img class="rounded-circle" src="{{ asset('assets/img/icons/user1 h 256.png') }}" alt="" /> 
                                    </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">   
                                        <a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a>
                                    </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>




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
                        <small type="text" class="btn btn-danger btn-block">
                            {{$message}}
                        </small> 
                    @enderror
                    @error('port')
                        <button type="text" disabled class="btn btn-danger btn-block" id="error" name="error">
                            {{$message}}
                        </button> 
                    @enderror
                    @error('setpoint')
                        <button type="text" disabled class="btn btn-danger btn-block" id="error" name="error">
                            {{$message}}
                        </button> 
                    @enderror  
                    @error('description')
                        <button type="text" disabled class="btn btn-danger btn-block" id="error" name="error">
                            {{$message}}
                        </button> 
                    @enderror  
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
                    <input class="form-control" id="description" name="description" type="text" value="{{ $data->description ? $data->description : '' }}" />
                </div>
                            
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>



    </div>
</div>
<!-- Presentación del Dashboard Juanicipio -->


@endsection