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

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br>
                    <div class="input-group">
                        <h2><a href="{{ url('/producto/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nuevo producto</a></h2>
                    </div>
                    <br>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Código</th>
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
                            <td>{{$product->id}}</td>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Editar</button>
                                <button type="button" class="btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    <div>

        <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modificar producto</h4>
                </div>

                <div class="modal-body">
                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="nombre" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="descripcion" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group form-inline">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Precio <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" placeholder="0.00" step="0.01"  id="precio" name="last-name" required="required" class="form-control col-md-4 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Serie <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="checkbox-inline"><input type="checkbox" name="serie" value=""> Check </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="marca">Marca <span class="required">*</span>
                                </label>
                                <div class="radio col-md-6 col-sm-6 col-xs-12">
                                    <select name="marca" id="" class="form-control">
                                        <option value="1">Marca ABCD1</option>
                                        <option value="2">Marca ABCD2</option>
                                        <option value="3">Marca ABCD3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nodelo">Modelo <span class="required">*</span>
                                </label>
                                <div class="radio col-md-6 col-sm-6 col-xs-12">
                                    <select name="modelo" id="" class="form-control">
                                        <option value="1">Modelo ABCD2</option>
                                        <option value="2">Modelo ABCD3</option>
                                        <option value="3">Modelo ABCD4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-inline">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Número de parte <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="numParte" name="last-name" required="required" class="form-control col-md-4 col-xs-12">
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
                                    <select name="categoria" id="" class="form-control">
                                        <option value="1">Marca XYZW1</option>
                                        <option value="2">Marca XYZW2</option>
                                        <option value="3">Marca XYZW3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Subcategoría <span class="required">*</span>
                                </label>
                                <div class="radio col-md-6 col-sm-6 col-xs-12">
                                    <select name="subcategoria" id="" class="form-control">
                                        <option value="1">Subcategoría XYZW2</option>
                                        <option value="2">Subcategoría XYZW3</option>
                                        <option value="3">Subcategoría XYZW4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Observación<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="observacion" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="from-group btn-group col-md-offset-4">
                                <button type="button" class="btn btn-primary btn-lg">Guardar</button>
                                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                  </div>
            </div>
        </div>
    </div>

@endsection
