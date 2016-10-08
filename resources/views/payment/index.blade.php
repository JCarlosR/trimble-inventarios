@extends('layouts.panel')

@section('title', 'Pagos')

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
                    <h2>Registro de pagos</h2>
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
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Lo sentimos! </strong>Por favor revise los siguientes errores.
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    <div class="x_content">
                        <br>
                        <div class="row">

                            <div class="col-md-5">
                                <label class="control-label col-md-2" for="facturas">
                                    Factura:
                                </label>
                                <div class="input-group">
                                    <input type="text" id="facturas" class="typeahead form-control">
                                </div>
                            </div>

                            <div class="">
                                <button type="button" class="btn btn-primary" id="btnPago" >Buscar</button>
                                <button type="button" class="btn btn-success" id="btnAddPay">Agregar pago</button>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2 col-sm-12">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Factura</th>
                                        <th>Monto pago</th>
                                        <th>Tipo pago</th>
                                        <th>Cod. Operación</th>
                                        <th>Fecha</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <template id="template-payment">
                                        <tr>
                                            <td data-factura>1000001</td>
                                            <td data-monto>256314</td>
                                            <td data-tipo>1</td>
                                            <td data-operacion>1</td>
                                            <td data-fecha>1</td>

                                            <td>
                                                <button data-delete type="button" class="btn btn-danger">Anular</button>
                                            </td>
                                        </tr>
                                    </template>

                                    <tbody id="table-payments">


                                    </tbody>
                                </table>
                            </div>
                            <template id="template-payment">
                                <tr>
                                    <td data-factura>1000001</td>
                                    <td data-monto>256314</td>
                                    <td data-tipo>1</td>
                                    <td data-operacion>1</td>
                                    <td data-fecha>1</td>

                                    <td>
                                        <button data-delete type="button" class="btn btn-danger">Anular</button>
                                    </td>
                                </tr>
                            </template>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalAddPayment" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar pago de la factura</h4>
                </div>
                <form id="form" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="factura" />
                        <div class="form-group">
                            <label for="monto">Ingrese el monto a pagar:</label>
                            <input type="text" class="form-control" id="monto" name="monto"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Ingrese el tipo de pago:</label>
                            <div class="input-group col-md-8">
                                <input type="radio" id="type" name="type" value="Efectivo" checked> Efectivo
                                <input type="radio" id="type" name="type" value="Deposito"> Depósito
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="operation">Ingrese el código de operación</label>
                            <input type="text" class="form-control" id="operation" name="operation"/>
                        </div>
                        <div class="form-group">
                            <label for="date">Ingrese la fecha de pago:</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $currentDate }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group pull-left">
                            <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Cancelar</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span> Guardar pago</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/payment/index.js') }}"></script>
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
            var facturas = {!! $facturas !!};
            $('#facturas').typeahead(
                    {
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'facturas',
                        source: substringMatcher(facturas)
                    }
            );
        });
    </script>
@endsection
