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
                    <h2>Salidas por ventas</h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="input-group">
                            <a href="{{ url('/salida/venta') }}" id="NvoIngreso" class="btn btn-success">
                                <i class="fa fa-plus-square-o"></i> Nueva venta
                            </a>
                        </div>
                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class=" control-label col-md-4 " for="cliente">
                                            Cliente:
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="text" id="clientes" class="typeahead form-control">
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
                                        <button data-href="{{ url('/salida/listar/venta/{cliente}/{inicio}/{fin}') }}" type="button" class="btn btn-primary btn-block" id="btnShowOutputs">Buscar ventas</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-1 col-sm-12">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Cód. Interno</th>
                                            <th>Factura</th>
                                            <th>Tipo</th>
                                            <th>Moneda</th>
                                            <th>Fecha</th>
                                            <th>Observación</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody id="bodyOutput" data-href="{{ url('/salida/listar/detalles/{id}') }}">
                                        @foreach($outputs as $output)
                                            <tr>
                                                <td>{{ $output->id }}</td>
                                                <td>{{ $output->invoice }}</td>
                                                <td>{{ ($output->type=='local'?'Local':'Extranjero') }}</td>
                                                <td>{{ $output->currency }}</td>
                                                <td>{{ $output->created_at }}</td>
                                                <td>{{ $output->comment }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-details="{{ $output->id }}" title="Listar detalles">
                                                        <i class="fa fa-list"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm" data-detraction="{{ $output->id }}" title="Detracción">
                                                        <i class="fa fa-bolt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" data-url="{{ url('factura') }}" data-invoice="{{ $output->id }}" title="Ver Factura">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-anular="{{ $output->id }}" title="Anular">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $outputs->render() !!}
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
                                            <td data-series></td>
                                            <td data-quantity></td>
                                            <td data-price></td>
                                            <td data-sub></td>
                                            <td data-location></td>
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
                                            <th>Ubicación</th>
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

    <div id="modalAnular" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Anular venta</h4>
                </div>
                <form action="{{ url('/salida/venta/anular') }}" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />

                        <div class="form-group">
                            <label>¿Está seguro que desea anular la venta seleccionada?</label>
                            <p>Deberá registrar la venta nuevamente y cargar los productos correspondientes.</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="btn-group pull-left">
                            <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Cancelar</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Aceptar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('salida.modal-detraction')
@endsection

@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/output/listaventa.js') }}"></script>
    <script>
        var detraction_url = '{{ url('/salida/detraction') }}';

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
