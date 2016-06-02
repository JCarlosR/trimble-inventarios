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
                        <h2><a href="{{ url('/paquete/registrar') }}" class="btn btn-success"><i class="fa fa-plus-square-o"></i> Nuevo paquete</a></h2>
                    </div>
                    <br>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Descripción</th>
                                        <th>Código</th>
                                        <th>Ubicación</th>
                                        <th>Observación</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>00001</td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>XYZ</td>
                                        <td>Observación</td>

                                        <td>
                                            <button type="button" class="btn btn-success" title="Ver contenido">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary" title="Editar">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" title="Eliminar">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
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