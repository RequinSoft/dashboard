@extends('layouts.template_admin')

@section('title', 'Barrenación')

@section('content')
<div class="card">
<div class="card-header d-flex flex-between-center ps-0 py-0 border-bottom">
    <ul class="nav nav-tabs border-0 flex-nowrap tab-active-caret" id="crm-revenue-chart-tab" role="tablist" data-tab-has-echarts="data-tab-has-echarts">
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0 active" id="crm-enero-tab" data-bs-toggle="tab" href="#crm-enero" role="tab" aria-controls="crm-enero" aria-selected="true">Enero</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-febrero-tab" data-bs-toggle="tab" href="#crm-febrero" role="tab" aria-controls="crm-febrero" aria-selected="false">Febrero</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-marzo-tab" data-bs-toggle="tab" href="#crm-marzo" role="tab" aria-controls="crm-marzo" aria-selected="false">Marzo   </a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-abril-tab" data-bs-toggle="tab" href="#crm-abril" role="tab" aria-controls="crm-abril" aria-selected="false">Abril</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-mayo-tab" data-bs-toggle="tab" href="#crm-mayo" role="tab" aria-controls="crm-mayo" aria-selected="false">Mayo</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-junio-tab" data-bs-toggle="tab" href="#crm-junio" role="tab" aria-controls="crm-junio" aria-selected="false">Junio</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-julio-tab" data-bs-toggle="tab" href="#crm-julio" role="tab" aria-controls="crm-julio" aria-selected="false">Julio</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-agosto-tab" data-bs-toggle="tab" href="#crm-agosto" role="tab" aria-controls="crm-agosto" aria-selected="false">Agosto</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-septiembre-tab" data-bs-toggle="tab" href="#crm-septiembre" role="tab" aria-controls="crm-septiembre" aria-selected="false">Septiembre</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-octubre-tab" data-bs-toggle="tab" href="#crm-octubre" role="tab" aria-controls="crm-octubre" aria-selected="false">Octubre</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-noviembre-tab" data-bs-toggle="tab" href="#crm-noviembre" role="tab" aria-controls="crm-noviembre" aria-selected="false">Noviembre</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-diciembre-tab" data-bs-toggle="tab" href="#crm-diciembre" role="tab" aria-controls="crm-diciembre" aria-selected="false">Diciembre</a></li>
    <li class="nav-item ms-3 mt-2 text-end" role="presentation">
        <a href="{{ route('barrenacion.nuevo', $equipo->id) }}" class="btn btn-falcon-primary btn-sm" type="button">
            <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>
            Añadir
        </a>
    </li>
    </ul>
</div>
<div class="card-body">
    <div class="row g-1">
    <div class="col-xxl-12">
        <div class="tab-content">
        
        <div class="tab-pane active" id="crm-enero" role="tabpanel" aria-labelledby="crm-enero-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($enero as $enero)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $enero->fecha ? \Carbon\Carbon::parse($enero->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $enero->equipo->name }}</td>
                                    <td class="text-center">{{ $enero->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $enero->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="crm-febrero" role="tabpanel" aria-labelledby="crm-febrero-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($febrero as $febrero)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $febrero->fecha ? \Carbon\Carbon::parse($febrero->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $febrero->equipo->name }}</td>
                                    <td class="text-center">{{ $febrero->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $febrero->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="crm-marzo" role="tabpanel" aria-labelledby="crm-marzo-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($marzo as $marzo)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $marzo->fecha ? \Carbon\Carbon::parse($marzo->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $marzo->equipo->name }}</td>
                                    <td class="text-center">{{ $marzo->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $marzo->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-abril" role="tabpanel" aria-labelledby="crm-abril-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($abril as $abril)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $abril->fecha ? \Carbon\Carbon::parse($abril->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $abril->equipo->name }}</td>
                                    <td class="text-center">{{ $abril->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $abril->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-mayo" role="tabpanel" aria-labelledby="crm-mayo-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($mayo as $mayo)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $mayo->fecha ? \Carbon\Carbon::parse($mayo->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $mayo->equipo->name }}</td>
                                    <td class="text-center">{{ $mayo->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $mayo->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-junio" role="tabpanel" aria-labelledby="crm-junio-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($junio as $junio)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $junio->fecha ? \Carbon\Carbon::parse($junio->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $junio->equipo->name }}</td>
                                    <td class="text-center">{{ $junio->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $junio->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-julio" role="tabpanel" aria-labelledby="crm-julio-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($julio as $julio)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $julio->fecha ? \Carbon\Carbon::parse($julio->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $julio->equipo->name }}</td>
                                    <td class="text-center">{{ $julio->barrenos_plan }}</td>
                                    <td class="text-center">{{ $julio->segundo_turno }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $julio->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-agosto" role="tabpanel" aria-labelledby="crm-agosto-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($agosto as $agosto)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $agosto->fecha ? \Carbon\Carbon::parse($agosto->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $agosto->equipo->name }}</td>
                                    <td class="text-center">{{ $agosto->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $agosto->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-septiembre" role="tabpanel" aria-labelledby="crm-septiembre-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($septiembre as $septiembre)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $septiembre->fecha ? \Carbon\Carbon::parse($septiembre->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $septiembre->equipo->name }}</td>
                                    <td class="text-center">{{ $septiembre->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $septiembre->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-octubre" role="tabpanel" aria-labelledby="crm-octubre-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($octubre as $octubre)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $octubre->fecha ? \Carbon\Carbon::parse($octubre->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $octubre->equipo->name }}</td>
                                    <td class="text-center">{{ $octubre->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $octubre->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-noviembre" role="tabpanel" aria-labelledby="crm-noviembre-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($noviembre as $noviembre)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $noviembre->fecha ? \Carbon\Carbon::parse($noviembre->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $noviembre->equipo->name }}</td>
                                    <td class="text-center">{{ $noviembre->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $noviembre->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="crm-diciembre" role="tabpanel" aria-labelledby="crm-diciembre-tab">
            <div id="tableExample2" data-list='{"valueNames":["plan","turno1","turno2","acciones"],"page":50,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--2 mb-0">
                        <thead class="bg-500 text-900">
                        <tr>
                            <th class="text-center sort" >Día</th>
                            <th class="text-center sort" data-sort="plan">Equipo</th>
                            <th class="text-center sort" data-sort="turno1">Plan</th>
                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($diciembre as $diciembre)
                                <tr class="btn-reveal-trigger">
                                    <td class="text-center">{{ $diciembre->fecha ? \Carbon\Carbon::parse($diciembre->fecha)->format('d') : '' }}</td>
                                    <td class="text-center">{{ $diciembre->equipo->name }}</td>
                                    <td class="text-center">{{ $diciembre->barrenos_plan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barrenacion.editar', $diciembre->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </div>
    </div>
    </div>
</div>
</div>
@endsection