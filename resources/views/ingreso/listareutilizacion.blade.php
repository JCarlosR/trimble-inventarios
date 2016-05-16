@extends('layouts.panel')

@section('title', 'Ingresos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ingresos por reutilizacion</h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="input-group">
                            <a id="NvoIngreso" class="btn btn-success" href="{{ url('/ingreso/reutilizacion') }}"><i class="fa fa-plus-square-o"></i>  Nuevo Ingreso</a>
                        </div>
                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-4" for="inicio">
                                            Desde:
                                        </label>
                                        <div class="input-group col-md-4">
                                            <input type="date" id="inicio" class="form-control" value="{{ $dateinicio }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label col-md-4" for="fin">
                                            Hasta:
                                        </label>
                                        <div class="input-group col-md-4">
                                            <input type="date" id="fin" class="form-control" value="{{ $datefin }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-5" >
                                    <button data-href="{{ url('/ingreso/listar/reutilizacion/{inicio}/{fin}') }}" type="button" class="btn btn-primary btn-block" id="btnShowEntries">Buscar reutilizacion</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2 col-sm-12">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ingreso</th>
                                            <th>Tipo</th>
                                            <th>Fecha</th>
                                            <th>Observacion</th>
                                        </tr>
                                        </thead>
                                        <tbody id="bodyEntries" data-href="{{ url('/ingreso/listar/detalles/{id}') }}">
                                        @foreach($entries as $entry)
                                            <tr>
                                                <th scope="row">1</th>
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
                                            <th scope="row">1</th>
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
                                            <th>#</th>
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
                            {{--
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">Retornar</button>
                                    <button type="submit" class="btn btn-danger">Cancelar</button>
                                </div>
                            </div>
                            --}}

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/entry/listareutilizacion.js') }}"></script>
@endsection