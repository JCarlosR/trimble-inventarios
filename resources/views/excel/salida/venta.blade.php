@extends('layouts.panel');

@section('title','Reporte de ventas')

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
    <br>
    <div class="row">
        <form id="form" action="{{ url('salida/venta/data')  }}" method="POST" class="form-horizontal form-label-left">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-3" for="cliente">Cliente: </label>
                    <div class="col-md-9">
                        <input type="text" id="cliente" name="cliente" class="typeahead form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-3" for="name">Inicio</label>
                    <div class="col-md-9">
                        <input type="date" id="inicio" name="inicio" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-3" for="name">Final</label>
                    <div class="col-md-9">
                        <input type="date" id="fin" name="fin" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <div class="form-group">
                    <button class="btn btn-primary" id="reporte">Reporte</button>
                    <button class="btn btn-success" id="excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
                    <button class="btn btn-danger" id="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="table table:stripped">
                <table>
                    <thead>

                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
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