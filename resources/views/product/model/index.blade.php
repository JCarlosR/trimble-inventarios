@extends('layouts.panel')

@section('title', 'Mantendedor de Modelos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title col-md-offset-5">
                    <h2><a href="{{ url('product/model/create') }}">Nuevo Modelo</a></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Modelo</th>
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                                <td>Modelo 1</td>
                                <td>Descripción 1</td>
                                <td>Marca 1</td>
                            <td>
                                <button type="button" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                                <td>Modelo 3</td>
                                <td>Descripción 3</td>
                                <td>Marca 3</td>
                            <td>
                                <button type="button" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">4</th>
                            <td>Modelo 4</td>
                            <td>Descripción 4</td>
                            <td>Marca 4</td>
                            <td>
                                <button type="button" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
