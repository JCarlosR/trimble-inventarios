@extends('layouts.panel')

@section('title', 'Ingresos')

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
                    <h2>Ingreso por compras</h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="input-group">
                            <a id="NvoIngreso" class="btn btn-success" href="{{ url('/ingreso/compra') }}"><i class="fa fa-plus-square-o"></i>  Nueva compra</a>
                        </div>
                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label col-md-4" for="proveedor">
                                            Proveedor:
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="text" id="proveedores" class="typeahead form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label col-md-4" for="fechaInicio">
                                            Desde:
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="date" id="inicio" class="form-control" value="{{ $dateinicio }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label col-md-4" for="fechaFin">
                                            Hasta:
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="date" id="fin" class="form-control" value="{{ $datefin }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-5" >
                                        <button data-href="{{ url('/ingreso/listar/compra/{proveedor}/{inicio}/{fin}') }}" type="button" class="btn btn-primary btn-block" id="btnShowEntries">Buscar compras</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2 col-sm-12">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Ingreso</th>
                                            <th>Tipo</th>
                                            <th>Fecha</th>
                                            <th>Observación</th>
                                        </tr>
                                        </thead>
                                        <tbody id="bodyEntries" data-href="{{ url('/ingreso/listar/detalles/{id}') }}">
                                        @foreach($entries as $entry)
                                        <tr>
                                            <td data-id="{{ $entry->id }}">{{ $entry->id+10000 }}</td>
                                            <td>{{ ($entry->type=='local'?'Local':'Extranjero') }}</td>
                                            <td>{{ $entry->created_at }}</td>
                                            <td>{{ $entry->comment }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalles</label>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <template id="template-detail">
                                        <tr>
                                            <td data-name></td>
                                            <td data-series>256314</td>
                                            <td data-quantity>1</td>
                                            <td data-price>1</td>
                                            <td data-sub>1</td>
                                        </tr>
                                    </template>
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Serie</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="bodyDetails">

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/entry/listacompra.js') }}"></script>
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
            var providers = {!! $providers !!};
            $('#proveedores').typeahead(
                    {
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'providers',
                        source: substringMatcher(providers)
                    }
            );
        });
    </script>
@endsection
