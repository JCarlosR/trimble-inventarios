@extends('layouts.panel')

@section('title', 'Modelos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <h2>Listado de modelos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">

                        <br>
                        <div class="input-group">
                            <h2><a href="{{ url('modelo/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nuevo modelo </a></h2>
                        </div>
                        <br>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Modelo</th>
                                <th>Descripción</th>
                                <th>Marca</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exemplars as $exemplar)
                                <tr>
                                    <td>{{$exemplar->id}}</td>
                                    <td>{{$exemplar->name}}</td>
                                    <td>{{$exemplar->description}}</td>
                                    <td>{{$exemplar->brand->name}}</td>
                                    <td>
                                        <button type="submit" class="btn btn-success" data-id="{{ $exemplar->id }}" data-name="{{ $exemplar->name }}"
                                                data-description="{{ $exemplar->description }} "> <i class="fa fa-pencil"></i>Editar
                                        </button>
                                        <button type="submit" class="btn btn-danger"  data-delete="{{ $exemplar->id }}" data-name="{{ $exemplar->name }}">
                                            <i class="fa fa-trash"></i>Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div id="modalEditar" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar marca</h4>
                    </div>
                    <form action="{{ url('modelo/modificar') }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />

                            <div class="form-group">
                                <label for="nombres">Nueva marca</label>
                                <input type="text" class="form-control" name="name" required/>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Nueva descripción</label>
                                <input type="text" class="form-control" name="description" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group pull-left">
                                <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                            </div>
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar Categoría</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="modalEliminar" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar modelo</h4>
                    </div>
                    <form action="{{ url('modelo/eliminar') }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea eliminar el siguiente modelo?</label>
                                <input type="text" readonly class="form-control" name="nombreEliminar"/>
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
    </div>
@endsection
<script src="{{ asset('js/products/jquery-1.7.min.js') }}"></script>
<script src="{{ asset('js/products/exemplars.js')}}"></script>