@extends('layouts.panel')

@section('title', 'Reportes')

@section('styles')
    <style>
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
                                <button id="exportExcel" data-url="{{ url('/salidas/range') }}" type="button" class="btn btn-success">Exportar en excel</button>
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
                                <label for="start2">Fecha inicial</label>
                                <input id="start2" name="start" type="date" value="" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="end2">Fecha final</label>
                                <input id="end2" name="end" type="date" value="" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="clientes">Cliente</label>
                                <input id="clientes" name="end" type="text" value="" class="typeahead form-control">
                            </div>
                            <div class="col-md-3">
                                <button id="exportExcel2" data-url="{{ url('/salidas/cliente') }}"type="button" class="btn btn-success">Exportar en excel</button>
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
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script>
        $(document).on('ready', function () {
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
            var customers = {!! $customers !!};
            $('#clientes').typeahead(
                    {
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'customers',
                        source: substringMatcher(customers)
                    }
            );
        });
    </script>
@endsection
