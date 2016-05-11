@extends('layouts.panel')

@section('title', 'Categorías')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <h2>Listado de categorías</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="input-group">
                            <h2><a href="{{ url('categoria/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nueva categoría</a></h2>
                        </div>

                        @if( $errors->count() > 0 )
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Lo sentimos!</strong> Por favor revise los siguientes errores.
                                        @foreach($errors->all() as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if( isset($notif) )
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-success" role="alert">
                                        <strong>Éxito! </strong> {{ $notif }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <br>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th>{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>
                                        <button type="submit" class="btn btn-success" data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                                data-description="{{ $category->description }} ">
                                            <i class="fa fa-pencil"></i>Editar
                                        </button>

                                        <button type="submit" class="btn btn-danger"  data-delete="{{ $category->id }}" data-name="{{ $category->name }}">
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
                        <h4 class="modal-title">Editar categoría</h4>
                    </div>
                    <form action="{{ url('categoria/modificar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />

                            <div class="form-group">
                                <label for="nombres">Nuevo nombre</label>
                                <input type="text" class="form-control" name="name" required/>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Nueva descripción</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group pull-left">
                                <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                            </div>
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar categoría</button>
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
                        <h4 class="modal-title">Eliminar categoría</h4>
                    </div>
                    <form action="{{ url('categoria/eliminar') }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea eliminar la siguiente categoría?</label>
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
<script src="{{ asset('js/products/categories.js')}}"></script>