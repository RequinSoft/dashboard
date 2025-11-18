@extends('layouts.template_admin')

@section('title', 'Administración - PI')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar Tag -- {{ $data->name }}</h5>
    </div>
    <div class="card-body bg-light">
        <form action="{{ route('pi.tags.update') }}" method="POST">
            @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div> 
                <div class="col-sm-12 mb-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)                                    
                                    <div class="alert alert-success" role="alert" id="error-alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                
                <div class="col-sm-3 mb-3">
                    <label class="form-label" for="event-venue">Nombre</label>
                    <input disabled class="form-control" id="name" name="name" type="text" value="{{ $data->name ? $data->name : '' }}" />
                </div>

                <div class="col-sm-3 mb-3">
                    <label class="form-label" for="event-venue">Tag</label>
                    <input class="form-control" id="tag" name="tag" type="text" value="{{ $data->tag ? $data->tag : '' }}" />
                </div>

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Descripción</label>
                    <input class="form-control" id="description" name="description" type="text" value="{{ $data->description ? $data->description : '' }}" />
                </div>
                          
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('pi.tags') }}" class="btn btn-danger btn-user btn-block">
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
@section('script')
<script>
    // Ocultar la alerta después de 3 segundos (3000 milisegundos)
    setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000);
</script>
<script>
    // Ocultar la alerta de error después de 5 segundos (5000 milisegundos)
    setTimeout(function() {
        var alert = document.getElementById('error-alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 5000);
</script>
@endsection