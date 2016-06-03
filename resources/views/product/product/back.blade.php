@extends('layouts.panel')

@section('title', 'Productos')

@section('styles')
    <style>
        .margen
        {
            margin-top:10px;
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
                    <h2>Listado de productos inactivos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content table-responsive">

                    <div class="col-md-3">
                        <h2><a href="{{ url('/producto') }}" class="btn btn-success"><i class="fa fa-backward"></i> Productos activos</a></h2>
                    </div>

                    <div class="col-md-6 input-group margen">
                        <span class="input-group-addon">Producto</span><input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                    </div>

                    <table class="table table-hover mytable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
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
                                <th data-type="html">Activar</th>
                            </tr>
                        </thead>

                        @foreach($products as $product)
                        <tbody id="tabla">
                            <tr>
                                <td>{{ str_limit($product->name, $limit = 33, $end = '...') }}</td>
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
                                    <span title="Activar">
                                        <button type="submit" class="btn btn-primary" data-habilitar="{{ $product->id }}" data-name="{{ $product ->name }}">
                                            <i class="fa fa-repeat"></i>
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

        <div id="modalHabilitar" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Habilitar producto</h4>
                    </div>
                    <form action="{{ url('/producto/habilitar') }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea habilitar el siguiente producto?</label>
                                <input type="text" readonly class="form-control" name="nombreHabilitar"/>
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
    <script src="{{ asset('js/products/enable.js') }}"></script>
    <script src="{{ asset('js/products/search.js') }}"></script>
@endsection