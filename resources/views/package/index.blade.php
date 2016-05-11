@extends('layouts.panel')

@section('title', 'Paquetes')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Listado de paquetes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <br>
                    <div class="input-group">
                        <h2><a href="{{ url('/paquete/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nuevo paquete</a></h2>
                    </div>
                    <br>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Serie</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>NumParte</th>
                                        <th>Color</th>
                                        <th>Categoría</th>
                                        <th>SubCategoría</th>
                                        <th>Observación</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>120.00</td>
                                        <td></td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                        <td>Azul</td>
                                        <td>A</td>
                                        <td>AB</td>
                                        <td>Observación</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>15.00</td>
                                        <td></td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                        <td>Azul</td>
                                        <td>A</td>
                                        <td>AB</td>
                                        <td>Observación</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>20.80</td>
                                        <td>002</td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                        <td>Azul</td>
                                        <td>A</td>
                                        <td>AB</td>
                                        <td>Observación</td>
                                    </tr>
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