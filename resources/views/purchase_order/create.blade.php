@extends('layouts.panel')

@section('title', 'Ingresos')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/typeahead.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Orden de Compra</h2>
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
                        <form id="form" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="factura">
                                            Nro. de documento:
                                        </label>
                                        <div class="input-group col-md-9">
                                            <input id="factura" name="factura" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label col-md-4" for="type">Tipo de Documento:</label>
                                        <div class="input-group col-md-8">
                                            <input type="radio" name="documento" value="F" checked> Factura
                                            <input type="radio" name="documento" value="B"> Boleta
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="sale_date">Fecha:</label>
                                        <div class="input-group col-md-9">
                                            <input type="date" class="form-control" name="invoice_date" id="invoice_date" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="proveedor">
                                            Proveedor:
                                        </label>
                                        <div class="input-group col-md-9">
                                            <input id="proveedor" name="proveedor" class="typeahead form-control" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6" for="type">Moneda:</label>
                                            <div class="input-group col-md-6">
                                                <input type="radio" name="moneda" value="PEN" checked> Soles
                                                <input type="radio" name="moneda" value="USD"> Dólares
                                            </div>
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

                            <!-- Modal -->
                            <template id="template-series">
                                <div class="form-group">
                                    <label for="serie">Ingrese serie:</label>
                                    <input type="text" class="typeahead form-control" name="serie" data-search>
                                </div>
                            </template>

                            {{-- Series modal --}}
                            <div class="modal fade" id="modalSeries" role="dialog">
                                <div class="modal-dialog modal-sm">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Ingrese las series</h4>
                                        </div>
                                        <div class="modal-body" id="bodySeries">
                                            {{-- Load with javascript after ajax requests --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" id="btnAccept">Aceptar</button>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- Fin modal --}}

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="button" id="btnAdd" class="btn-primary form-control">Agregar a la lista</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lista</label>
                            </div>

                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>IGV</th>
                                            <th>Monto IGV</th>
                                            <th>Subtotal</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <template id="template-item">
                                            <tr>
                                                <td data-name></td>
                                                <td data-quantity></td>
                                                <td data-price></td>
                                                <td>
                                                    <input type="checkbox" data-igvserie>
                                                </td>
                                                <td data-igvmonto></td>
                                                <td data-sub></td>
                                                <td>
                                                    <button data-delete type="button" class="btn btn-danger">Quitar</button>
                                                </td>
                                            </tr>
                                        </template>
                                        <template id="template-package">
                                            <tr>
                                                <th data-i scope="row"></th>
                                                <td data-name></td>
                                                <td data-quantity></td>
                                                <td data-price></td>
                                                <td>
                                                    <input type="checkbox" data-igvserie>
                                                </td>
                                                <td data-igvmonto></td>
                                                <td data-sub></td>
                                                <td>
                                                    <button data-look type="button" class="btn btn-primary">Ver</button>
                                                    <button data-delete type="button" class="btn btn-danger">Quitar</button>
                                                </td>
                                            </tr>
                                        </template>
                                        <tbody id="table-items">
                                            {{-- Load with javascript --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">

                                        <label class="control-label col-md-3 col-xs-12" for="envio">Costo de envío:
                                        </label>
                                        <div class="col-md-4">
                                            <input type="number" min="1" step="1" id="costenvio" class="form-control" value="0">
                                        </div>
                                        IGV: <input type="checkbox" id="envioigv" >
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-xs-12" for="igv">Igv:
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" id="igv" class="form-control" readonly value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-md-3 col-xs-12" for="total">Total:
                                        </label>
                                        <div class="col-md-4">
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
                                        <textarea style="resize: none" name="observacion" class="form-control col-md-7 col-xs-12" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                    <button class="btn btn-primary">Registrar venta </button>
                                    <a href="{{ url('/salida/listar/venta') }}" class="btn btn-danger">Cancelar venta </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


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
    <script src="{{ asset('js/purchase-order/create.js') }}"></script>
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

        var providers = {!! $proveedores !!};

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

    </script>
@endsection
