@extends('layouts.template_admin')

@section('title', 'Administración - PI')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar Tags</h5>
    </div>
    <div class="card-body bg-light">
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div> 

                @foreach ($data as $item)
                    <div class="col-sm-12 mb-2 row">
                        <div class="col-sm-3 mb-3">
                            <label class="form-label" for="event-venue">Nombre</label>
                            <input disabled class="form-control" id="name" name="name" type="text" value="{{ $item->name ? $item->name : '' }}" />
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label class="form-label" for="event-venue">Tag</label>
                            <input disabled class="form-control" id="tag" name="tag" type="text" value="{{ $item->tag ? $item->tag : '' }}" />
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label class="form-label" for="event-venue">Descripción</label>
                            <input disabled class="form-control" id="description" name="description" type="text" value="{{ $item->description ? $item->description : '' }}" />
                        </div>
                        <div class="col-sm-2 mb-3 mt-4 d-flex align-items-center">
                            <a href="{{ route('pi.tags.edit', $item->id) }}" class="btn btn-sm btn-primary" title="Editar Tag">
                                <span class="fas fa-edit" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>

                    @can('pi.WebId')
                            <hr class="mb-0 navbar-vertical-divider" />
                        <div class="col-sm-12 mt-3 row">
                            <div class="col-sm-6 mb-3">
                                <input disabled class="form-control" type="text" value="{{ $item->webid ? $item->webid : '' }}" />
                            </div>
                        </div>
                    @endcan
                    
                @endforeach               

            </div>
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
@endsection