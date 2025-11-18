@extends('layouts.template_admin')

@section('title', 'Barrenación Equipo')

@section('content')

<div class="card mb-3">
<div class="card-body">
    <div class="row">
        @foreach($equipos as $equipo)
            <div class="mb-4 col-md-6 col-lg-4">
                <div class="border rounded-1 h-100 d-flex flex-column justify-content-between pb-3">
                <div class="overflow-hidden">
                    <div class="position-relative rounded-top overflow-hidden"><a class="d-block" href="{{ route('barrenacion.tabla', $equipo->id) }}"><img class="img-fluid rounded-top" src="{{ asset('assets/img/jumbo.svg') }}" alt="" /></a>
                    </div>
                    <div class="p-3">
                    <h5 class="fs-0"><a class="text-dark" href="{{ route('barrenacion.tabla', $equipo->id) }}">{{ $equipo->name }}</a></h5>
                    <p class="fs--1 mb-3"><a class="text-500" href="#!">{{ $equipo->contractor ? $equipo->contractor : '' }}</a></p>
                    <h5 class="fs--1 mb-1">Plan {!! $equipo->drill_plan->isNotEmpty() ? "<strong class='text-success'>".$equipo->drill_plan->first()->barrenos_plan."</strong>" : "<strong class='text-danger'>Sin Plan el día de hoy</strong>" !!}</h5>
                    
                    </div>
                </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
@endsection
@section('script')
    <script src="{{ asset('vendors/swiper/swiper-bundle.min.js') }}"></script>
@endsection