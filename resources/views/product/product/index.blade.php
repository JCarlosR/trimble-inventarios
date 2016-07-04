@extends('layouts.panel')

@section('title', 'Productos')

@section('styles')
    <style>
        .margen
        {
            margin-top:11px;
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
    <link rel="stylesheet" href="{{asset('css/footable.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
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
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                <strong>Lo sentimos! </strong>Por favor revise los siguientes errores.
                                @foreach($errors->all() as $message)
                                    <p>{{$message}}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="col-md-3">
                        <h2><a href="{{ url('/producto/registrar') }}" class="btn btn-success"><i class="fa fa-plus-square-o"></i> Nuevo producto</a></h2>
                    </div>
                    <div class="col-md-9 form-inline">
                        <div class="col-md-8 input-group margen">
                            <span class="input-group-addon">Producto</span><input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                        </div>

                        <div class="col-md-3 margen pull-right">
                            <a href="{{ url('/producto/inactivos') }}" class="btn btn-dark" type="button"><i class="fa fa-lock"></i> Restablecer eliminados</a>
                        </div>
                    </div>

                    <table class="table table-hover mytable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th data-type="html"> Imagen </th>
                                <th data-hide="all" data-breakpoints="all" data-title="Descripción"></th>
                                <th>Precio</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th data-hide="all" data-breakpoints="all" data-title="Número de parte"></th>
                                <th data-hide="all" data-breakpoints="all" data-title="Color"></th>
                                <th data-breakpoints="all">Categoría</th>
                                <th data-breakpoints="all">Subcategría</th>
                                <th data-hide="all" data-breakpoints="all" data-title="Observación"></th>
                                <th data-type="html">Editar | Eliminar</th>
                            </tr>
                        </thead>

                        <tbody id="tabla">
                        @foreach($products as $product)
                            <tr>
                                <td>{{ str_limit($product->name, $limit = 33, $end = '...') }}</td>
                                <td>{{$items_per_Product[$product->id]}}</td>
                                <td ><img src="{{ asset('images/products') }}/{{ $product->image }} " class="img-responsive image"></td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->price}} @if($product->money ==1) S/.  @else $ @endif </td>
                                <td>{{ str_limit($product->brand->name, $limit = 20, $end = '...') }}</td>
                                <td> {{ str_limit($product->exemplar->name, $limit = 20, $end = '...') }}</td>
                                <td>{{$product->part_number}}</td>
                                <td>{{$product->color}}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->subcategory->name}}</td>
                                <td>{{ $product->comment}}</td>
                                <td>
                                    <span title="Editar">
                                        <button type="submit" class="btn btn-success" data-id="{{ $product->id }}" data-name="{{ $product ->name }}"
                                                data-description="{{ $product->description }}"  data-price="{{ $product->price }}" data-money="{{ $product->money }}"
                                                data-brand="{{ $product->brand_id }}" data-exemplar="{{ $product->exemplar_id }}" data-part="{{ $product->part_number }}"
                                                data-color="{{ $product->color }}" data-category="{{ $product->category_id }}" data-subcategory="{{ $product->subcategory_id }}"
                                                data-image="{{ $product->image }}" data-comment="{{ $product->comment }}">
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
                        @endforeach
                        </tbody>
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
                                <div class="col-md-8">
                                    <input type="text" id="name" name="name" required="required" class="form-control inside">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Descripción <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <textarea id="description" name="description" rows="2" class="form-control no-resize inside"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Precio <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <input type="number" placeholder="0.00" step="0.01"  min="0" id="price" name="price" required="required" class="form-control inside">
                                </div>
                                <label class="control-label col-md-2" for="">Moneda<span class="required">*</span></label>
                                <div class="col-md-4">
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
                                    <label class="control-label col-md-2" for="last-name">Modelo</label>
                                    <div class="col-md-3">
                                        <select name="exemplars" id="exemplars" class="form-control inside">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Número de parte <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" id="part_number" name="part_number" class="form-control inside">
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="last-name">Color <span class="required">*</span></label>
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
                                    <label class="control-label col-md-2" for="last-name">Subcategory</label>
                                    <div class="col-md-3">
                                        <select name="subcategories" id="subcategories" class="form-control insisde">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3"  for="image">Nueva Imagen</label>
                                <div class="col-md-5">
                                    <input type="file" name="image" class="form-control inside" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="last-name">Imagen anterior</label>
                                    <div class="col-md-2" id="oldImage">    </div>
                                    <input type="hidden" name="oldImage">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Observación<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <textarea name="comment" id="comment" rows="2" class="form-control no-resize inside"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar producto</button>
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
    <script src="{{ asset('js/footable.min.js') }}"></script>
    <script src="{{ asset('js/products/productsmodal.js') }}"></script>
    <script src="{{ asset('js/products/search.js') }}"></script>
@endsection