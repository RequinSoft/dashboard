@extends('layouts.template_admin')

@section('title', 'Administración - PI')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar Persona del Equipo Líder</h5>
    </div>
    <div class="card-body bg-light">     
        <form action="{{ route('pl-person.update', $person->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-sm-6">
            <input name="image" type="file" id="imageInput" accept="image/*" style="display: none;" onchange="previewImage(event)">
            <img  class="img-thumbnail img-fluid rounded-circle mb-3 shadow-sm cursor-pointer" 
                id="imagePreview"
                src="{{ $person->image ? asset('avatars/'.$person->image) : asset('assets/img/team/avatar.png') }}" 
                alt="" width="100" 
                onclick="document.getElementById('imageInput').click()" />

            <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    document.getElementById('imagePreview').src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
            </script>
            </div>
            <div class="col-sm-6">                           
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
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div> 
            </div>

            <div class="col-sm-4 mb-2"><input type="text" name="name" value="{{ $person->name }}" class="form-control" /></div>
            <div class="col-sm-4 mb-2"><input type="text" name="position" value="{{ $person->position }}" class="form-control" /></div>
            <div class="col-sm-4 mb-2"><input type="text" name="id" value="{{ $person->id }}" class="form-control" hidden/></div>

            <a href="{{ route('pl-people.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>

                            
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
@endsection