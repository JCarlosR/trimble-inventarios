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
                    <h2>Ingreso por compra</h2>
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
                        <form id="form" class="form-horizontal form-label-left" novalidate>
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="proveedor">
                                            Proveedor:
                                        </label>
                                        <div class="input-group col-md-9">
                                            <input id="proveedor" name="proveedor" class="typeahead form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="tipo">Tipo:</label>

                                        <div class="input-group col-md-9">
                                            <input type="radio" name="tipo" value="local" checked>Local
                                            <input type="radio" name="tipo" value="foreign">Extranjero
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
                                            <input type="text" id="producto" class="typeahead form-control">
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
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4">
                                        <button type="button" id="btnAdd" class="btn btn-primary btn-block">Agregar a la lista</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2 col-sm-12">
                                    <p>Lista de productos</p>
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Serie</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table-items">
                                        <template id="template-item">
                                            <tr>
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


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-xs-12" for="cliente">Total
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" id="total" class="form-control" readonly value="0">
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="observacion">Observación:
                                    </label>
                                    <div class=" input-group col-md-8 col-sm-6 col-xs-12">
                                        <textarea style="resize:none" name="observacion" class="form-control col-md-7 col-xs-12" rows="3" resi></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">Registrar compra</button>
                                    <a href="{{ url('/ingreso/listar/compra') }}" class="btn btn-danger">Cancelar compra</a>
                                </div>
                            </div>
                        </form>

                        <!-- Modal -->
                        <template id="template-series">
                            <div class="form-group">
                                <label for="serie">Ingrese serie:</label>
                                <input type="text" class="form-control">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/entry/compra.js') }}"></script>
    <script>
        $(document).on('ready', function () {
            var substringMatcher = function(strs) {
                return function findMatches(q, cb) {
                    var matches, substrRegex;
                    matches = [];
                    substrRegex = new RegExp(q, 'i');
                    $.each(strs, function(i, str) {
                        if (substrRegex.test(str)) {
                            matches.push(str);
                        }
                    });
                    cb(matches);
                };
            };

            var providers = {!! $proveedores !!};
            var products = {!! $productos !!};

            $('#proveedor').typeahead(
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

            $('#producto').typeahead(
                    {
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'products',
                        source: substringMatcher(products)
                    }
            );
        });
    </script>
@endsection
