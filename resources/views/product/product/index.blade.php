@extends('layouts.panel')

@section('title', 'Productos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Listado de productos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"></div>

                <div class="x_content">

                    <div class="input-group">
                        <h2><a href="{{ url('/producto/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nuevo producto</a></h2>
                    </div>
                    <br>

                    <table class="table table-hover">
                        <thead>
                        <tr>
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
                        @foreach($products as $product)
                        <tbody>
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->series}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->exemplar->name}}</td>
                            <td>{{$product->part_number}}</td>
                            <td>{{$product->color}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->subcategory->name}}</td>
                            <td>{{$product->comment}}</td>
                            <td>
                                <button type="submit" class="btn btn-success" data-id="{{ $product->id }}" data-name="{{ $product ->name }}"
                                        data-description="{{ $product->description }} "><i class="fa fa-pencil"></i>Editar
                                </button>

                                <button type="submit" class="btn btn-danger"  data-delete="{{ $product->id }}" data-name="{{ $product->name }}">
                                    <i class="fa fa-trash"></i>Eliminar
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div id="modalEditar" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar producto</h4>
                </div>
                <form action="{{ url('producto/modificar') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />

                        <div class="form-group">
                            <label for="nombres">Nuevo nombre</label>
                            <input type="text" class="form-control" name="name" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Nueva descripción</label>
                            <input type="text" class="form-control" name="description"/>
                        </div>

                        <div class="form-group form-inline">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nuevo precio <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" placeholder="0.00" step="0.01"  name="precio" name="last-name" required="required" class="form-control col-md-4 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Serie <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="checkbox-inline"><input type="checkbox" name="series" value="1" checked> Check </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="marca">Marca <span class="required">*</span>
                            </label>
                            <div class="radio col-md-6 col-sm-6 col-xs-12">
                                <select name="marca" id="" class="form-control"> </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nodelo">Modelo <span class="required">*</span>
                            </label>
                            <div class="radio col-md-6 col-sm-6 col-xs-12">
                                <select name="modelo" id="" class="form-control"> </select>
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Número de parte <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="part_number" class="form-control col-md-4 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Color <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="color" required="required" class="form-control col-md-4 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Categoría <span class="required">*</span>
                            </label>
                            <div class="radio col-md-6 col-sm-6 col-xs-12">
                                <select name="categoria" id="" class="form-control"> </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Subcategoría <span class="required">*</span>
                            </label>
                            <div class="radio col-md-6 col-sm-6 col-xs-12">
                                <select name="subcategoria" id="" class="form-control"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Observación<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="observacion" name="last-name" class="form-control col-md-7 col-xs-12">
                            </div>
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
                    <h4 class="modal-title">Eliminar producto</h4>
                </div>
                <form action="{{ url('producto/eliminar') }}" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label for="nombreEliminar">¿Desea eliminar el siguiente producto?</label>
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
<script src="{{ asset('js/products/products.js')}}"></script>