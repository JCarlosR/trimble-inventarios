@extends('layouts.panel')

@section('title', 'Ingresos')

@section('title-right')
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Órdenes de compra</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/ingreso/orden_compra') }}">Nueva orden</a>
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
                    <a href="{{ url('/ingreso/orden_compra') }}" class="btn btn-success"><i class="fa fa-plus-square-o"></i>  Nueva orden</a>
                </div>

                <div class="x_content">

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1 col-sm-12">
                                <div class="form-inline col-md-8">
                                    <div class="col-md-8 input-group margen">
                                        <span class="input-group-addon">Código de Órden</span>
                                        <input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('#') }}" class="btn btn-dark" type="button"><i class="fa fa-lock"></i> Restablecer orden</a>
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

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/customer/customer-index.js')}}"></script>
    <script src="{{ asset('js/customer/search.js') }}"></script>
@endsection
