@extends('layouts.panel')

@section('title', 'Salidas')

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
                    <h2>Salida por alquiler</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#">Settings 1</a>
                                </li>
                                <li>
                                    <a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <form id="form" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                            {{ csrf_field() }}
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="cliente">
                                            Cliente:
                                        </label>
                                        <div class="input-group col-md-9">
                                            <input id="cliente" name="cliente" class="typeahead form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="destination">Destino:</label>

                                        <div class="input-group col-md-9">
                                            <input type="text" name="destination" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="fecha">Fecha alquiler:</label>

                                        <div class="input-group col-md-9">
                                            <input type="date" name="fechaAlquiler" class="form-control" value="{{ $currentDate }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="fecha">Fecha retorno:</label>

                                        <div class="input-group col-md-9">
                                            <input type="date" name="fechaRetorno" class="form-control" value="{{ $currentDate }}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="producto">Producto:
                                        </label>
                                        <div class="input-group col-md-9">
                                            <input type="text" id="product" class="typeahead form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label col-md-4" for="cantidad">Cantidad:
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="number" min="1" step="1" id="cantidad" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label col-md-4" for="precio">Precio:
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="number" min="0" step="0.01" id="precio" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="button" id="btnAdd" class="btn-primary form-control col-md-7 col-xs-12">Agregar a la lista</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lista</label>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Serie</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <template id="template-item">
                                            <tr>
                                                <th data-i scope="row">1</th>
                                                <td data-name>1000001</td>
                                                <td data-series>256314</td>
                                                <td data-quantity>1</td>
                                                <td data-price>1</td>
                                                <td data-sub>1</td>
                                                <td>
                                                    <button data-delete type="button" class="btn btn-danger">Quitar</button>
                                                </td>
                                            </tr>
                                        </template>
                                        <template id="template-package">
                                            <tr>
                                                <th data-i scope="row">1</th>
                                                <td data-name>1000001</td>
                                                <td data-series>256314</td>
                                                <td data-quantity>1</td>
                                                <td data-price>1</td>
                                                <td data-sub>1</td>
                                                <td>
                                                    <button data-look type="button" class="btn btn-primary">Ver</button>
                                                    <button data-delete type="button" class="btn btn-danger">Quitar</button>
                                                </td>
                                            </tr>
                                        </template>
                                        <tbody id="table-items">



                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Total
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="total" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">

                                    <label class="control-label col-md-3" for="observacion">Observación:
                                    </label>
                                    <div class="col-md-6">
                                        <textarea style="resize: none" name="observacion" class="form-control col-md-7 col-xs-12" rows="3"></textarea>
                                    </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                    <button class="btn btn-primary">Registrar alquiler</button>
                                    <a href="{{ url('/salida/listar/alquiler') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <template id="template-series">
        <div class="form-group">
            <label for="serie">Ingrese serie:</label>
            <input type="text" class="typeahead form-control" data-search>
        </div>
    </template>
    <div class="modal fade" id="modalSeries" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ingrese las series</h4>
                </div>
                <div class="modal-body" id="bodySeries">



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnAccept">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>
    {{-- Fin modal --}}

    <!-- Modal -->
    <div class="modal fade" id="modalDetails" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detalles del paquete</h4>
                </div>
                <div class="modal-body" id="bodyDetails">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Serie</th>
                            <th>Precio</th>
                        </tr>
                        </thead>
                        <template id="template-details">
                            <tr>
                                <td data-name>1000001</td>
                                <td data-series>256314</td>
                                <td data-price>1</td>
                            </tr>
                        </template>
                        <tbody id="table-details">



                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                </div>
            </div>

        </div>
    </div>

    {{-- Fin modal --}}
@endsection
@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/output/alquiler.js') }}"></script>
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

        var customers = {!! $clientes !!};
        $('#cliente').typeahead(
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
    </script>

@endsection