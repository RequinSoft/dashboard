@extends('layouts.template_admin')

@section('title', 'Administración - PI')

@section('content')
<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Equipo Líder</h5>
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

                <div class="card-body bg-light px-1 py-0">
                    <div class="row g-0 text-center fs--1">
                    @foreach($people as $person)
                        <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-1 px-2">
                            <div class="bg-white dark__bg-1100 p-3 h-100"><a href="../../pages/user/profile.html"><img class="img-thumbnail img-fluid rounded-circle mb-3 shadow-sm" src="{{asset('assets/img/team/avatar.png')}}" alt="" width="100" /></a>
                                <h6 class="mb-1"><a href="../../pages/user/profile.html">{{ $person->name }}</a>
                                </h6>
                                <p class="fs--2 mb-1"><a class="text-700" href="#!">{{ $person->puesto }}</a></p>
                            </div>
                        </div>
                    @endforeach
                    </div>
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
@endsection