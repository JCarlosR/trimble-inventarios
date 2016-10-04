@extends('layouts.panel')

@section('title', 'Caja chica')

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
                    <h2>Registro de ventas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th rowspan="2">RUBRO</th>
                                    <th rowspan="2">CLIENTE</th>
                                    <th rowspan="2">Nro. FACTURA</th>
                                    <th rowspan="2">FECHA EMISION</th>
                                    <th colspan="3">SOLES</th>
                                    <th colspan="3">DOLARES</th>
                                    <th colspan="2">ACUMULADO</th>
                                    <th colspan="2">TOTAL GENERAL</th>
                                    <th rowspan="2">COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <th>Facturado</th>
                                    <th>Liberado</th>
                                    <th>Subtotal</th>

                                    <th>Facturado</th>
                                    <th>Liberado</th>
                                    <th>Subtotal</th>
                                    <th>Soles</th>
                                    <th>Dolares</th>
                                    <th>Soles</th>
                                    <th>Dolares</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($outputs as $output)
                                    <tr>
                                        <td >{{ 'VENTAS' }}
                                        <td>{{ $output->customers->name}}</td>
                                        <td> {{ $output->invoice }}
                                            <a target="_blank" href="{{ $urlInvoice }}" id="showInvoice" data-invoice="{{$output->invoice}}" data-url="{{url('/show/invoice')}}" data-urlInvoice="{{ $urlInvoice }}" class="btn btn-info"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></a>
                                        </td>
                                        <td>{{ $output->created_at }}</td>
                                        <td>{{ 12  }}</td>
                                        <td>{{ 00  }}</td>
                                        <td>{{ 12 }}</td>
                                        <td>{{ 12  }}</td>
                                        <td>{{ 00  }}</td>
                                        <td>{{ 12 }}</td>
                                        <td>{{ 12  }}</td>
                                        <td>{{ 00  }}</td>
                                        <td>{{ 12 }}</td>
                                        <td>{{ 00  }}</td>
                                        <td>{{ $output->comment }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
    <script src="{{ asset('js/output/reportVentas.js') }}"></script>
@endsection
