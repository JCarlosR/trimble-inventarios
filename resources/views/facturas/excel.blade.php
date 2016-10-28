@extends('layouts.panel')

@section('title', 'Seguimiento de documentos')
@section('styles')
    <style>
        .padding{
            padding-right:4px;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de facturas: año</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <br>
                        <div class="row">
                            <form id="formYear" action="{{url('facturas-annio')}}" method="POST">
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                                <div class="col-md-3">
                                    <b>Año</b>
                                    <input type="number" name="year" id="year" value="{{$year}}" class="form-control" required>
                                </div>

                                <div class="col-md-3 col-md-offset-1">
                                    <b>Estado de documento</b><br>
                                    <input type="checkbox" name="pay_year" value="0">Pagados &ensp;
                                    <input type="checkbox" name="wait_year" value="1">Pendientes
                                </div>

                                <div class="col-md-2 ">
                                    <b>Exportar</b><br>
                                    <button class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de facturas: mes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <br>
                        <div class="row">
                            <form id="formMonth" action="{{url('facturas-mes')}}" method="POST">
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                                <div class="col-md-3">
                                    <b>Mes</b>
                                    <select name="month" id="month" class="form-control">
                                        <option value="1" {{( $month==1 )? 'selected' :'' }}>Enero</option>
                                        <option value="2" {{( $month==2 )? 'selected' :'' }}>Febrero</option>
                                        <option value="3" {{( $month==3 )? 'selected' :'' }}>Marzo</option>
                                        <option value="4" {{( $month==4 )? 'selected' :'' }}>Abril</option>
                                        <option value="5" {{( $month==5 )? 'selected' :'' }}>Mayo</option>
                                        <option value="6" {{( $month==6 )? 'selected' :'' }}>Junio</option>
                                        <option value="7" {{( $month==7 )? 'selected' :'' }}>Julio</option>
                                        <option value="8" {{( $month==8 )? 'selected' :'' }}>Agosto</option>
                                        <option value="9" {{( $month==9 )? 'selected' :'' }}>Setiembre</option>
                                        <option value="10" {{( $month==10)? 'selected':'' }}>Octubre</option>
                                        <option value="11" {{( $month==11)? 'selected':'' }}>Noviembre</option>
                                        <option value="12" {{( $month==12)? 'selected':'' }}>Diciembre</option>
                                    </select>
                                </div>

                                <div class="col-md-3 col-md-offset-1">
                                    <b>Estado de documento</b><br>
                                    <input type="checkbox" name="pay_month" value="0"> Pagados &ensp;
                                    <input type="checkbox" name="wait_month" value="1"> Pendientes
                                </div>

                                <div class="col-md-2 ">
                                    <b>Exportar</b><br>
                                    <button class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de facturas: rango de fechas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <br>
                        <div class="row">
                            <form id="formDate" action="{{url('facturas-fecha')}}" method="POST">
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                                <div class="col-md-3">
                                    <b>Inicio</b><br>
                                    <input type="date" name="start" id="start" value="{{$start}}" class="form-control">
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <b>Final</b><br>
                                    <input type="date" name="end" id="end" value="{{$end}}" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <b>Estado de documento</b><br>
                                    <input type="checkbox" name="pay_date" value="0"> Pagados
                                    <input type="checkbox" name="wait_date" value="1"> Pendientes
                                </div>

                                <div class="col-md-2">
                                    <label for="export">Exportar</label><br>
                                    <button class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/invoice/excel.js')}}"></script>
@endsection