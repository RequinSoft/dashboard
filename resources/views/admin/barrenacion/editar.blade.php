@extends('layouts.template_admin')

@section('title', 'Barrenos - Editar')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar Barrenos</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('barrenacion.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div> 

                
                <div class="col-sm-3 mb-3">
                    <label class="form-label" for="event-venue">Fecha</label>
                    <input class="form-control" id="fecha" name="fecha" type="date" value="{{ old('fecha', isset($data->fecha) && $data->fecha ? \Carbon\Carbon::parse($data->fecha)->format('Y-m-d') : '') }}" disabled/>
                    <input class="form-control" id="fecha" name="fecha" type="date" value="{{ old('fecha', isset($data->fecha) && $data->fecha ? \Carbon\Carbon::parse($data->fecha)->format('Y-m-d') : '') }}" hidden/>
                    <input class="form-control" id="id" name="id" type="number" value="{{ old('id', isset($data->id) ? $data->id : '') }}" hidden/>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label" for="event-venue">Plan</label>
                        <input class="form-control" id="barrenos_plan" name="barrenos_plan" type="number" step="0.01" value="{{ old('barrenos_plan', isset($data->plan) ? $data->plan : '') }}" required/>
                    </div>
                    <div class="col-sm-3 mb-3">
                    </div>
                    <div class="col-sm-3 mb-3">
                    </div>
                          
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('molienda.index') }}" class="btn btn-danger btn-user btn-block">
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