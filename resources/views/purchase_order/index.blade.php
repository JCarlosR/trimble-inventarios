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

@section('styles')
    <style>
        .date
        {
            margin-top: 24px;
        }
    </style>
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

                <div class="row">
                    <a href="{{ url('/ingreso/orden_compra') }}" class="btn btn-success pull-left"><i class="fa fa-plus-square-o"></i>  Nueva orden</a>
                    <a href="{{ url('#') }}" class="btn btn-dark pull-right" type="button"><i class="fa fa-lock"></i> Restablecer orden</a>
                </div>
                <br>

                <div class="x_content">

                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="form-inline col-md-5 date">
                                    <div class="col-md-10 input-group margen">
                                        <span class="input-group-addon"> <span class="glyphicon glyphicon-search"></span> </span>
                                        <input type="text" id="search" class="form-control" placeholder="Documento ...">
                                    </div>
                                </div>

                                <div class="form-group col-md-7">
                                    <div class="col-md-4">
                                        <label for="">Desde:</label>
                                        <input type="date" id="start" value="{{$inicio}}" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Hasta:</label>
                                        <input type="date" id="end" value="{{$fin}}" class="form-control">
                                    </div>
                                    <div class="col-md-4 date">
                                        <button class="btn btn-primary form-control" id="filter">Filtrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <table  class="table table-condensed table-hover" id="data">
                        <thead>
                            <tr>
                                <th>Nombre/Raz. Soc.</th>
                                <th>Moneda</th>
                                <th>IGV</th>
                                <th>Total</th>
                                <th>Envío</th>
                                <th>Documento</th>
                                <th>Tipo</th>
                                <th>Fecha emisión</th>
                            </tr>
                        </thead>
                        <tbody id="orders">

                        </tbody>
                    </table>

                    <table  class="table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>IGV</th>
                            <th>SubTotal</th>
                        </tr>
                        </thead>
                        <tbody id="details">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/pager.js')}}"></script>
    <script src="{{ asset('js/purchase-order/index.js')}}"></script>
@endsection
