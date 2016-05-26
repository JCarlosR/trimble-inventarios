@extends('layouts.panel')

@section('title', 'Productos')

@section('styles')
    <style>
        .margen
        {
            margin-top:16px;
        }
        .no-resize
        {
            resize: none;
        }
        .inside:focus{
            border: 1px solid #0097cf;
        }
        .image
        {
            height: 40px;
            width: 40px;
        }
    </style>
@endsection

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

                <div class="x_content table-responsive">

                    @if( $errors->count() > 0 )
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Lo sentimos! </strong>Por favor revise los siguientes errores.
                                    @foreach($errors->all() as $message)
                                        <p>{{$message}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-inline">
                        <div class="col-md-4">
                            <h2><a href="{{ url('/producto/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nuevo producto</a></h2>
                        </div>

                        <div class="col-md-8 input-group margen">
                                <span class="input-group-addon">Producto</span>
                                <input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                        </div>
                    </div>



                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th></th>
                            <th>Serie</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Num_Parte</th>
                            <th>Categoría</th>
                            <th>Subcategoría</th>
                            <th>Imagen</th>
                            <th>Funcionalidad</th>
                        </tr>
                        </thead>

                        @foreach($products as $product)
                        <tbody id="tabla">
                            <tr>
                                <td>{{ str_limit($product->name, $limit = 20, $end = '...') }}</td>
                                <td>{{$product->price}}</td>
                                <td>@if($product->money ==1) S/.  @else $ @endif </td>
                                <td>@if($product->series ==1) Sí  @else No @endif </td>
                                <td>{{ str_limit($product->brand->name, $limit = 5, $end = '...') }}</td>
                                <td> {{ str_limit($product->exemplar->name, $limit = 6, $end = '...') }}</td>
                                <td>{{$product->part_number}}</td>
                                <td>{{ str_limit($product->category->name, $limit = 7, $end = '...') }}</td>
                                <td>{{ str_limit($product->subcategory->name, $limit = 7, $end = '...') }}</td>
                                <td><img src="{{ asset('images/products') }}/{{ $product->image }} " class="img-responsive image"></td>
                                <td>
                                    <span title="Editar">
                                        <button type="submit" class="btn btn-success" data-id="{{ $product->id }}" data-name="{{ $product ->name }}"
                                                data-description="{{ $product->description }}"  data-price="{{ $product->price }}" data-money="{{ $product->money }}"  data-series="{{ $product->series }}"
                                                data-brand="{{ $product->brand_id }}" data-exemplar="{{ $product->exemplar_id }}" data-part="{{ $product->part_number }}"
                                                data-color="{{ $product->color }}" data-category="{{ $product->category_id }}" data-subcategory="{{ $product->subcategory_id }}"
                                                data-comment="{{ $product->comment }}">

                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </span>
                                    <span title="Eliminar">
                                        <button type="submit" class="btn btn-danger"  data-delete="{{ $product->id }}" data-name="{{ $product->name }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                    {!! $products->render() !!}
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
                                <label class="control-label col-md-3" for="name">Nombre <span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" id="name" name="name" required="required" class="form-control inside">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Descripción <span class="required">*</span></label>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                    <textarea id="description" name="description" rows="2" class="form-control no-resize inside"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Precio <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <input type="number" placeholder="0.00" step="0.01"  min="0" id="price" name="price" required="required" class="form-control inside">
                                </div>
                                <div class="form-group form-inline">
                                    <label class="control-label col-md-1" for="last-name">Serie <span class="required">*</span></label>
                                    <div class="col-md-3 checkbox">
                                        <input type="checkbox" id="series" name="series">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="">Moneda<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <input type="radio" id="soles" name="money" value="1" >Soles
                                    <input type="radio" id="dollar" name="money" value="2" >Dólares</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Marca</label>
                                <div class="col-md-3">
                                    <select id="brands" name="brands" class="form-control inside">

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1" for="last-name">Modelo</label>
                                    <div class="col-md-3">
                                        <select name="exemplars" id="exemplars" class="form-control inside">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Número de parte <span class="required">*</span></label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="part_number" name="part_number" class="form-control inside">
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="last-name">Color <span class="required">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="color" name="color" required="required" class="form-control inside">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Categoría</label>
                                <div class="col-md-3">
                                    <select name="categories" id="categories" class="form-control inside">

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1" for="last-name">Subcategory</label>
                                    <div class="col-md-3">
                                        <select name="subcategories" id="subcategories" class="form-control insisde">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3"  for="image">Imagen</label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control inside" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Observación<span class="required">*</span></label>
                                <div class="col-md-7">
                                    <textarea name="comment" id="comment" rows="2" class="form-control no-resize inside"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="btn-group pull-left">
                                <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                            </div>
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar producto</button>
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

@section('scripts')
    <script src="{{ asset('js/products/productsmodal.js') }}"></script>
    <script src="{{ asset('js/products/search.js') }}"></script>
@endsection