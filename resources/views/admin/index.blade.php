@extends('layouts.template_admin')

@section('title', 'Administración')

@section('content')

<div class="row g-0 mt-3">

    <div class="col-lg-4 pe-lg-2 mb-3">
        <div class="card h-lg-100 overflow-hidden">

            <div class="card-header bg-light">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="mb-0">Plan x Equipo</h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">

                    <div class="col ps-card py-1 position-static">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl me-3">
                                <div class="avatar-name rounded-circle bg-soft-primary text-dark">
                                    <span class="fs-0 text-primary">
                                        
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h6 class="mb-0 d-flex align-items-center">
                                    <a class="text-800 stretched-link" href="#!">
                                        
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="col py-1">
                        <div class="row flex-end-center g-0">

                            <div class="col-auto pe-2">
                                <div class="fs--1 fw-semi-bold">mts

                                </div>
                            </div>
                            
                            <div class="col-5 pe-card ps-2">
                                <div>
                                    <div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>
            
            </div>
        </div>

        <div class="col-lg-4 ps-lg-2 mb-3">
            <div class="card h-lg-100">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-auto">
                            <h6 class="mb-0"></h6>
                        </div>
                    </div>
                </div>
                <div class="card-body h-100 pe-0">

                </div>
            </div>
        </div>

        <div class="col-lg-4 ps-lg-2 mb-3">
            <div class="card h-lg-100">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-auto">
                            <h6 class="mb-0">Medidor Principal</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 pe-card ps-2">

                    <div class="card-body z-index-1">
                        <div class="row g-2 h-100 align-items-end">
                            <div class="col-sm-6 col-md-5">
                            <div class="d-flex position-relative">
                                <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-network-wired text-primary"></span></div>
                                <div class="flex-1"><a class="stretched-link" href="#!">
                                    <h6 class="text-800 mb-0">Medidor</h6>
                                </a>
                                <p class="mb-0 fs--2 text-500">Ip</p>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                            <div class="d-flex position-relative">
                                <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-network-wired text-warning"></span></div>
                                <div class="flex-1"><a class="stretched-link" href="#!">
                                    <h6 class="text-800 mb-0">Puerto</h6>
                                </a>
                                <p class="mb-0 fs--2 text-500">Puerto</p>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                            <div class="d-flex position-relative">
                                <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-at text-success"></span></div>
                                <div class="flex-1"><a class="stretched-link" href="#!">
                                    <h6 class="text-800 mb-0">Descripcion</h6>
                                </a>
                                <p class="mb-0 fs--2 text-500">Nombre</p>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                            <div class="d-flex position-relative">
                                <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-level-up-alt text-info"></span></div>
                                <div class="flex-1"><a class="stretched-link" href="#!">
                                    <h6 class="text-800 mb-0">Setpoint Kw</h6>
                                </a>
                                <p class="mb-0 fs--2 text-500">Set Point</p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>





        <div class="col-md-6">
        </div>

        <div class="col-md-12">

            <div class="card bg-100 shadow-none border">
            </div>

            <table class="table table-bordered table-striped fs--2 mb-0">
                <thead class="bg-500 text-900">
                <tr>
                    <th class="text-center sort" >N°</th>
                    <th class="text-center sort" data-sort="usuario">Log</th>
                    <th class="text-center sort" data-sort="nombre">Usuario</th>
                    <th class="text-center sort" data-sort="email">Fecha</th>
                </tr>
                </thead>
                <tbody class="list">
                    <tr>
                        <td class="text-center sort" ></td>
                        <td class="equipo sort"></td>
                        <td class="plan text-end sort"></td>
                        <td class="fecha text-end sort"></td>
                    </tr>
                </tbody>
            </table>
        </div>



    </div>
</div>
<!-- Presentación del Dashboard Juanicipio -->


@endsection