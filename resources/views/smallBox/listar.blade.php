@extends('layouts.panel')

@section('title', 'Caja chica')

@section('styles')
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap-table.css') }}" rel="stylesheet">
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
                    <h2>Listado de conceptos a la caja chica</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="row">
                            <a href="{{ url('/cajachica') }}" id="NvoConcepto" class="btn btn-success">
                                <i class="fa fa-plus-square-o"></i> Nuevo Concepto
                            </a>
                        </div>
                        @if(isset($assignmes))
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                                        <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Dia</th>
                                            <th>Concepto</th>
                                            <th>Ingresos</th>
                                            <th>Egresos</th>
                                            <th>A favor</th>
                                            <th>Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table-items">
                                        <tr>
                                            <td><b>{{$assignmes->id}}</b></td>
                                            <td><b>{{$assignmes->created_at}}</b></td>
                                            <td><b>{{$assignmes->concept}}</b></td>
                                            <td><b>{{$assignmes->amount}}</b></td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <?php  $afavor=$assignmes->amount; ?>
                                        @foreach($conceptos as $concepto)
                                            <tr>
                                                <td>
                                                    {{$concepto->id}}
                                                </td>
                                                <td>
                                                    {{$concepto->created_at}}
                                                </td>
                                                <td>
                                                    {{$concepto->concept}}
                                                </td>
                                                <td>
                                                    @if($concepto->type == 'input' ){{$concepto->amount}}@else{{0}}@endif
                                                </td>
                                                <td>
                                                    @if($concepto->type == 'output' ){{$concepto->amount}}@else{{0}}@endif
                                                </td>
                                                <td>
                                                    @if($concepto->type == 'input' ){{$afavor=$afavor+$concepto->amount}}@else{{$afavor=$afavor-$concepto->amount}}@endif
                                                </td>
                                                <td>
                                                    <button data-id="{{$concepto->id}}" data-desc="{{$concepto->concept}}" data-type="{{$concepto->type}}" data-amount="{{$concepto->amount}}" type="button" class="editar btn btn-warning">Editar</button>
                                                    <button data-delete="{{$concepto->id}}" type="button" class="btn btn-danger">Anular</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        @endif
                        <br>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalConcept" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modificar Concepto</h4>
                </div>
                <div class="modal-body" id="bodyConcept">
                        <div style="visibility: hidden; display: none">
                            <input type="text" id="idModal" name="id">
                        </div>
                        <div class="form-group">
                            <label for="serie">Concepto:</label>
                            <input type="text" class="form-control" id="conceptModal" name="concepto">
                        </div>
                        <div class="form-group">
                            <label for="serie">Monto:</label>
                            <input type="number" class="form-control" id="amountModal" name="monto">
                        </div>
                        <div class="form-group">
                            <label for="serie">Tipo:</label>
                            <select id="typeConcept" class="form-control" disabled>
                                <option value="input">Ingreso</option>
                                <option value="output">Salida</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="btnAccept">Aceptar</button>
                    <button type="button" class="btn btn-danger" onclick="limpiarCampos()">Cancelar</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    {{-- Fin modal --}}
@endsection

@section('scripts')
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('js/smallBox/listar.js') }}"></script>
@endsection




