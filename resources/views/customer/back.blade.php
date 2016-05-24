@extends('layouts.panel')

@section('title', 'Dashboard')

@section('title-right')
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar clientes ...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Clientes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/clientes') }}">Clientes activos</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>
                <div class="input-group">
                    <a href="{{ url('/clientes') }}" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i>  Clientes activos</a>
                </div>

                <div class="x_content">

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1 col-sm-12">
                                <div class="form-inline col-md-8">
                                    <div class="col-md-8 input-group margen">
                                        <span class="input-group-addon">Cliente</span>
                                        <input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                                    </div>

                                </div>

                                <table  class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre/Raz. Soc.</th>
                                            <th>Doc. Identidad</th>
                                            <th>Direccion</th>
                                            <th>Denominación</th>
                                            <th>Teléfono</th>
                                            <th>Tipo</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table">
                                    @foreach( $clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->name }}</td>
                                            <td>{{ $cliente->document }}</td>
                                            <td>{{ $cliente->address }}</td>
                                            <td>{{ $cliente->type }}</td>
                                            <td>{{ $cliente->phone }}</td>
                                            <td>{{ $cliente->customer_type->name }}</td>
                                            <td>
                                                <button type="button"  class="btn btn-primary" data-back="{{ $cliente->id }}" data-name="{{ $cliente->name }}"><i class="fa fa-repeat"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $clientes->render() !!}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div id="modalRetornar" class="modal fade in">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar cliente</h4>
                </div>
                <form action="{{ url('/clientes/restablecer') }}" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label for="nombreRetornar">¿Desea restablecer el siguiente cliente?</label>
                            <input type="text" readonly class="form-control" id="nombreRetornar" name="nombreRetornar"/>
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
@endsection

@section('scripts')
    <script src="{{ asset('js/customer/search.js') }}"></script>
    <script src="{{ asset('js/customer/customer-back.js') }}"></script>
@endsection
