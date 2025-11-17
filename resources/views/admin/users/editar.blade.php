@extends('layouts.template_admin')

@section('title', 'Usuarios')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar Usuario</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('usuarios.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>   

                <div class="col-sm-2">
                    <div class="avatar avatar-6xl position-relative">
                        <img id="preview" class="img-thumbnail shadow-sm cursor-pointer" 
                            src="{{ $user->img ? asset('avatars/avatars/'.$user->img) : asset('assets/img/team/avatar.png') }}" 
                            width="200" alt="Company logo" 
                            onclick="document.getElementById('logo').click()"
                            style="cursor: pointer;" />
                        
                        <div class="mt-3">
                            <input type="file" class="form-control d-none" id="logo" name="logo" 
                                accept="image/*" onchange="previewImage(this)"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 row">
                    <div class="col-sm-4">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <label class="form-label" for="event-venue">Usuario</label>
                        <input class="form-control" id="user" name="user" type="text" value="{{ $user->user }}" />
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Nombre Completo</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $user->name }}" />
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Email</label>
                        <input class="form-control" id="email" name="email" type="email" value="{{ $user->email }}" />
                    </div>

                    @if ($ldap->status == 1 && $user->name != 'admin')
                        <div class="col-sm-4">
                            <label class="form-label" for="event-venue">Autenticación</label>
                            <select class="form-select" id="authen" name="authen">
                                <option value="1" {{ old('authen') == 1 ? 'selected' : '' }}>Local</option>
                                <option value="2" {{ old('authen') == 2 ? 'selected' : '' }}>LDAP</option>
                            </select>
                        </div>
                    @else    
                        <div class="col-sm-4">
                            <label class="form-label" for="event-venue">Autenticación</label>
                            <input hidden class="form-control" id="auth" name="auth" type="text" value="1" readonly />
                            <input class="form-control" type="text" value="Local" readonly />
                        </div>
                    @endif
                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Rol</label>
                        <select class="form-select" id="role" name="role">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="event-venue">Estado</label>
                        <input class="form-control" id="status" name="status" type="text" value="Activo" readonly />
                    </div>

                    <div id="passwordFields" style="{{ old('authen') == 2 ? 'display:none;' : '' }}" class="row w-100 mt-3">
                        <div class="col-sm-4">
                            <label class="form-label" for="event-venue">Contraseña</label>
                            <input class="form-control" id="password" name="password" type="password" value="{{ old('password') }}" />
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label" for="event-venue">Confirmar Contraseña</label>
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" />
                        </div>
                    </div>

                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var authEl = document.getElementById('authen');
                        var pwWrapper = document.getElementById('passwordFields');
                        if (!authEl || !pwWrapper) return;

                        function togglePasswordFields() {
                            if (authEl.value === '2') {
                                pwWrapper.style.display = 'none';
                            } else {
                                pwWrapper.style.display = '';
                            }
                        }

                        // Initial state
                        togglePasswordFields();

                        // Listen for changes (works for select or hidden/text input)
                        authEl.addEventListener('change', togglePasswordFields);
                    });
                    </script>
                </div>
                          
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-danger btn-user btn-block">
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
@section('script')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection