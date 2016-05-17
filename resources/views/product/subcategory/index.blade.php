@extends('layouts.panel')

@section('title', 'Subcategorías')

@section('content')
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listado de subcategorías</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="input-group">
                            <h2><a href="{{ url('subcategoria/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nueva subcategoría</a></h2>
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
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Subcategoría</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{$subcategory->id}}</td>
                                    <td>{{str_limit($subcategory->name, $limit = 10, $end = '...') }}</td>
                                    <td>{{str_limit($subcategory->description, $limit = 15, $end = '...') }}</td>
                                    <td>{{str_limit($subcategory->category->name, $limit = 20, $end = '...') }}</td>
                                    <td>
                                        <button type="submit" class="btn btn-success" data-id="{{ $subcategory->id }}" data-name="{{ $subcategory ->name }}"
                                                data-description="{{ $subcategory->description }}" data-category="{{ $subcategory->category_id }} ">
                                            <i class="fa fa-pencil"></i>Editar
                                        </button>

                                        <button type="submit" class="btn btn-danger"  data-delete="{{ $subcategory->id }}" data-name="{{ $subcategory->name }}">
                                            <i class="fa fa-trash"></i>Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $subcategories->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div id="modalEditar" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar subcategoría</h4>
                    </div>
                    <form action="{{ url('subcategoria/modificar') }}" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <select name="categories" id="categories" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group pull-left">
                                <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                            </div>
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar subcategoría</button>
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
                        <h4 class="modal-title">Eliminar subcategoría</h4>
                    </div>
                    <form action="{{ url('subcategoria/eliminar') }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea eliminar la siguiente subcategoría?</label>
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

@section('scripts')
    <script src="{{ asset('js/products/subcategories.js')}}"></script>
@endsection