@extends('layouts.panel')

@section('title', 'Seguimiento de facturas')
@section('styles')
    <style>
        .margin{
            margin-top:23px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de facturas por mes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <label for="start">Mes</label>
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
                            <div class="col-md-1 col-md-offset-1 margin">
                                <input type="checkbox" name="state" value="1">Pagados
                            </div>
                            <div class="col-md-2 margin">
                                <input type="checkbox" name="state" value="2">Pendientes
                            </div>
                            <div class="col-md-2 ">
                                <label for="start">Exportar</label><br>
                                <button class="btn btn-success" id="excelV"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection