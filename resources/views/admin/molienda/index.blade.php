@extends('layouts.template_admin')

@section('title', 'Molienda')

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
                                            <th class="text-center sort" data-sort="plan">Plan</th>
                                            <th class="text-center sort" data-sort="turno1">Turno 1</th>
                                            <th class="text-center sort" data-sort="turno2">Turno 2</th>
                                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach($enero as $enero)
                                                <tr class="btn-reveal-trigger">
                                                    <td class="text-center">{{ $enero->fecha ? \Carbon\Carbon::parse($enero->fecha)->format('d') : '' }}</td>
                                                    <td class="text-center">{{ $enero->plan }}</td>
                                                    <td class="text-center">{{ $enero->primer_turno }}</td>
                                                    <td class="text-center">{{ $enero->segundo_turno }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('molienda.editar', $enero->id) }}" class="btn btn-sm btn-primary">Editar</a>
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
                                            <th class="text-center sort" data-sort="plan">Plan</th>
                                            <th class="text-center sort" data-sort="turno1">Turno 1</th>
                                            <th class="text-center sort" data-sort="turno2">Turno 2</th>
                                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach($febrero as $febrero)
                                                <tr class="btn-reveal-trigger">
                                                    <td class="text-center">{{ $febrero->fecha ? \Carbon\Carbon::parse($febrero->fecha)->format('d') : '' }}</td>
                                                    <td class="text-center">{{ $febrero->plan }}</td>
                                                    <td class="text-center">{{ $febrero->primer_turno }}</td>
                                                    <td class="text-center">{{ $febrero->segundo_turno }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('molienda.editar', $febrero->id) }}" class="btn btn-sm btn-primary">Editar</a>
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
                                            <th class="text-center sort" data-sort="plan">Plan</th>
                                            <th class="text-center sort" data-sort="turno1">Turno 1</th>
                                            <th class="text-center sort" data-sort="turno2">Turno 2</th>
                                            <th class="text-center sort" data-sort="acciones">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach($marzo as $marzo)
                                                <tr class="btn-reveal-trigger">
                                                    <td class="text-center">{{ $marzo->fecha ? \Carbon\Carbon::parse($marzo->fecha)->format('d') : '' }}</td>
                                                    <td class="text-center">{{ $marzo->plan }}</td>
                                                    <td class="text-center">{{ $marzo->primer_turno }}</td>
                                                    <td class="text-center">{{ $marzo->segundo_turno }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('molienda.editar', $marzo->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="crm-abril" role="tabpanel" aria-labelledby="crm-abril-tab">
                        </div>

                        <div class="tab-pane" id="crm-mayo" role="tabpanel" aria-labelledby="crm-mayo-tab">
                        </div>

                        <div class="tab-pane" id="crm-junio" role="tabpanel" aria-labelledby="crm-junio-tab">
                        </div>

                        <div class="tab-pane" id="crm-julio" role="tabpanel" aria-labelledby="crm-julio-tab">
                        </div>

                        <div class="tab-pane" id="crm-agosto" role="tabpanel" aria-labelledby="crm-agosto-tab">
                        </div>

                        <div class="tab-pane" id="crm-septiembre" role="tabpanel" aria-labelledby="crm-septiembre-tab">
                        </div>

                        <div class="tab-pane" id="crm-octubre" role="tabpanel" aria-labelledby="crm-octubre-tab">
                        </div>

                        <div class="tab-pane" id="crm-noviembre" role="tabpanel" aria-labelledby="crm-noviembre-tab">
                        </div>

                        <div class="tab-pane" id="crm-diciembre" role="tabpanel" aria-labelledby="crm-diciembre-tab">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
@endsection