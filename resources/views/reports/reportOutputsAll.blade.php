@extends('layouts.panel')

@section('title', 'Reportes')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de Salidas en general</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="start">Fecha inicial</label>
                                <input id="start" name="start" type="date" value="" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="end">Fecha final</label>
                                <input id="end" name="end" type="date" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button id="exportExcel" type="button" class="btn btn-success">Exportar en excel</button>
                                <button id="exportPDf" type="button" class="btn btn-info">Exportar en pdf</button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de Salidas en General por Cliente</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="start">Fecha inicial</label>
                                <input name="start" type="date" value="" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="end">Fecha final</label>
                                <input name="end" type="date" value="" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="end">Cliente</label>
                                <input name="end" type="text" value="" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success">Exportar en excel</button>
                                <button type="button" class="btn btn-info">Exportar en pdf</button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/report/reportOutputsAll.js') }}"></script>
@endsection
