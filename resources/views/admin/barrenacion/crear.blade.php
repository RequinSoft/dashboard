@extends('layouts.template_admin')

@section('title', 'Añadir - Plan')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">{{ $equipo->name }}</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('barrenacion.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert" id="error-message">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert" id="error-message">
                            {{ session('error') }}
                        </div>
                    @endif
                </div> 

                <div class="col-sm-12 row">
                    <div class="col-sm-3">
                        <label class="form-label" for="event-venue">Equipo</label>
                        <input class="form-control" id="equipo_id" name="equipo_id" type="text" value="{{ $equipo->id }}" hidden/>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $equipo->name }}" disabled/>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label" for="event-venue">Plan de Barrenos</label>
                        <input type="number" class="form-control" id="barrenos_plan" name="barrenos_plan" value="{{ old('barrenos_plan') }}"/>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="event-venue">Fecha Inicial</label>
                        <input class="form-control" id="fecha_inicio" name="fecha_inicio" type="date" value="{{ old('fecha_inicio') }}" required/>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label" for="event-venue">Fecha Final</label>
                        <input class="form-control" id="fecha_final" name="fecha_final" type="date" value="{{ old('fecha_final') }}" required/>
                    </div>

                </div>
                <div class="col-6 mt-3 text-end">
                    <a href="{{ route('barrenacion.index') }}" class="btn btn-danger btn-user btn-block">
                        Cancelar
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