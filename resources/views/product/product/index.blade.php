@extends('layouts.panel')

@section('title', 'Productos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Listado de productos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>


                <div class="x_content">
                    <br>
                    <div class="input-group">
                        <h2><a href="{{ url('/producto/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nuevo producto</a></h2>
                    </div>


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

                        </tr>
                        </thead>
                        @foreach($products as $product)
                        <tbody>
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>@if($product->series ==1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->exemplar->name}}</td>
                            <td>{{$product->part_number}}</td>
                            <td>{{$product->color}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->subcategory->name}}</td>

                            <td>
                                <button type="submit" class="btn btn-success" data-id="{{ $product->id }}" data-name="{{ $product ->name }}"
                                        data-description="{{ $product->description }}  data-price="{{ $product->price }} data-series="{{ $product->series }}
                                        data-brand="{{ $product->brand_id }} data-exemplar="{{ $product->exemplar_id }} data-part="{{ $product->part_number }}
                                        data-color="{{ $product->color }}" data-category="{{ $product->category_id }}" data-subcategory="{{ $product->subcategory_id }}">
                                    <i class="fa fa-pencil"></i>Editar
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar producto</h4>
                    </div>

                    <form action="{{ url('producto/modificar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="description" name="description" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Precio <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <input type="number" placeholder="0.00" step="0.01"  id="price" name="price" required="required" class="form-control col-md-4 col-xs-12">
                                </div>

                                <div class="form-group form-inline">
                                    <label class="control-label col-md-1" for="last-name">Serie <span class="required">*</span></label>
                                    <div class="col-md-3 checkbox">
                                        <input type="checkbox" id="series" name="series" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Marca <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <select id="brands" name="brands" class="form-control">

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1" for="last-name">Modelo <span class="required">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <select name="exemplars" id="exemplars" class="form-control">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Número de parte <span class="required">*</span></label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="part_number" name="part_number" class="form-control col-md-4 col-xs-12">
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="last-name">Color <span class="required">*</span></label>
                                    <div class="col-md-2">
                                        <input type="text" id="color" name="color" required="required" class="form-control col-md-4 col-xs-12">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Categoría <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <select name="categories" id="categories" class="form-control">

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1" for="last-name">Subcategoría <span class="required"></span></label>
                                    <div class="col-md-2">
                                        <select name="subcategories" id="subcategories" class="form-control">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Observación<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="comment" id="comment" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="modal-footer">
                            <div class="btn-group pull-left">
                                <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                            </div>
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar producto</button>
                            </div>
                        </div>
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