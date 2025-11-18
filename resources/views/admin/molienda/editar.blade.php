@extends('layouts.template_admin')

@section('title', 'Molienda')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Configurar Plan de Molienda</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('molienda.update') }}" method="POST" enctype="multipart/form-data">
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
                    <input class="form-control" id="fecha" name="fecha" type="date" value="{{ old('fecha', isset($molienda->fecha) && $molienda->fecha ? \Carbon\Carbon::parse($molienda->fecha)->format('Y-m-d') : '') }}" disabled/>
                    <input class="form-control" id="fecha" name="fecha" type="date" value="{{ old('fecha', isset($molienda->fecha) && $molienda->fecha ? \Carbon\Carbon::parse($molienda->fecha)->format('Y-m-d') : '') }}" hidden/>
                    <input class="form-control" id="id" name="id" type="number" value="{{ old('id', isset($molienda->id) ? $molienda->id : '') }}" hidden/>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label class="form-label" for="event-venue">Plan</label>
                        <input class="form-control" id="plan" name="plan" type="number" step="0.01" value="{{ old('plan', isset($molienda->plan) ? $molienda->plan : '') }}" required/>
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