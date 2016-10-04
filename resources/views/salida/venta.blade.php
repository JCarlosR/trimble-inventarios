@extends('layouts.panel')

@section('title', 'Salidas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/typeahead.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Salida por venta</h2>
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
                                        <label class="control-label col-md-3" for="factura">
                                            Nro. Factura:
                                        </label>
                                        <div class="input-group col-md-9">
                                            <input id="factura" name="factura" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="type">Moneda:</label>
                                        <div class="input-group col-md-9">
                                            <input type="radio" name="moneda" value="soles" checked> Soles
                                            <input type="radio" name="moneda" value="dolares"> Dólares
                                        </div>
                                    </div>
                                </div>
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
                                        <label class="control-label col-md-3" for="type">Tipo:</label>
                                        <div class="input-group col-md-9">
                                            <input type="radio" name="tipo" value="local" checked> Local
                                            <input type="radio" name="tipo" value="foreign"> Extranjero
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
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="serie">Ingrese serie:</label>--}}
                                            {{--<input type="text" class="typeahead form-control" data-search>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div>--}}
                                            {{--<label for="serie">Ingrese ubicación:</label>--}}
                                            {{--<input type="text" class="typeahead form-control" data-location>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{----}}
                                {{--</div>--}}

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

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="button" id="btnAdd" class="btn-primary form-control">Agregar a la lista</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lista</label>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Serie</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>IGV</th>
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
                                                <td>
                                                    <input type="checkbox" data-igvserie>
                                                </td>
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
                                                <td>
                                                    <input type="checkbox" data-igvserie>
                                                </td>
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
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-xs-12" for="total">Total
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

    <!-- Modal -->
    {{--<template id="template-series">--}}
        {{--<div class="form-group">--}}
            {{--<label for="serie">Ingrese serie:</label>--}}
            {{--<input type="text" class="typeahead form-control" data-search>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="ubicacion">Ingrese ubicación:</label>--}}
            {{--<input type="text" class="typeahead form-control" data-ubicacion>--}}
        {{--</div>--}}
    {{--</template>--}}
    {{--<div class="modal fade" id="modalSeries" role="dialog">--}}
        {{--<div class="modal-dialog modal-sm">--}}

            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    {{--<h4 class="modal-title">Ingrese las series</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body" id="bodySeries">--}}



                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-success" id="btnAccept">Aceptar</button>--}}
                    {{--<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}

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
    <script src="{{ asset('js/output/venta.js') }}"></script>
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
