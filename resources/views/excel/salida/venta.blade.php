@extends('layouts.panel');

@section('title','Reporte de ventas')

@section('styles')
    <style>
        .margin{
            margin-top:23px;;
        }
        .typeahead,
        .tt-query,
        .tt-hint {
            line-height: 30px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            outline: none;
        }
        .typeahead:focus {
            border: 1px solid #0097cf;
        }
        .tt-query {
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }
        .tt-hint {
            color: #bdbdbd;
        }
        .tt-menu {
            margin: 12px 0;
            padding: 8px 0;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 4px;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
            box-shadow: 0 5px 10px rgba(0,0,0,.2);
            color: #000;
        }
        .tt-suggestion {
            padding: 3px 20px;
            line-height: 24px;
        }
        .tt-suggestion:hover {
            cursor: pointer;
            color: #fff;
            background-color: #0097cf;
        }
        .tt-suggestion.tt-cursor {
            color: #fff;
            background-color: #0097cf;
        }
        .tt-suggestion p {
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de salidas por venta</h2>
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
                            <div class="col-md-4 col-md-offset-1">
                                <label for="start">Cliente*</label>
                                <input type="text" id="clienteV" name="clienteV" class="typeahead form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="start">Fecha inicial</label>
                                <input type="date" id="inicioV" name="inicioV" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="end">Fecha final</label>
                                <input type="date" id="finV" name="finV" class="form-control">
                            </div>
                            <div class="col-md-3 margin">
                                <button class="btn btn-success" id="excelV"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                                <button class="btn btn-danger" id="pdfV"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button>
                            </div>
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
                    <h2>Reporte de salidas por alquiler</h2>
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
                            <div class="col-md-4 col-md-offset-1">
                                <label for="start">Cliente*</label>
                                <input type="text" id="clienteA" name="clienteA" class="typeahead form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="start">Fecha inicial</label>
                                <input type="date" id="inicioA" name="inicioA" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="end">Fecha final</label>
                                <input type="date" id="finA" name="finA" class="form-control">
                            </div>
                            <div class="col-md-3 margin">
                                <button class="btn btn-success" id="excelA"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                                <button class="btn btn-danger" id="pdfA"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button>
                            </div>
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
                    <h2>Reporte de salidas por baja</h2>
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
                            <div class="col-md-4 col-md-offset-1">
                                <label for="start">Fecha inicial</label>
                                <input type="date" id="inicioB" name="inicioB" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="end">Fecha final</label>
                                <input type="date" id="finB" name="finB" class="form-control">
                            </div>
                            <div class="col-md-3 margin">
                                <button class="btn btn-success" id="excelB"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                                <button class="btn btn-danger" id="pdfB"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button>
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
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/excel/venta.js') }}"></script>
    <script>
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };
    </script>
@endsection