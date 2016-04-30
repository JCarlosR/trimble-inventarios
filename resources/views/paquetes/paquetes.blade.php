@extends('layouts.panel')

@section('title', 'Creación de Packs')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Registrar nuevo paquete</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br>
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Producto<span class="required">*</span>
                            </label>
                            <div class="input-group col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control " placeholder="Buscar producto ...">
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" data-toggle="modal" data-target="#myModal" type="button">Ver series</button>
                                    </span>
                            </div>

                        </div>

                        <div class="form-group pull-right form-inline">
                                <button type="submit" class="btn btn-success">Agregar</button>
                                <button type="reset" class="btn btn-danger">Eliminar</button>
                        </div>


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                                <div class="x_title">
                                    <h2>Paquete</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li>
                                            <a class="close-link"><i class="fa fa-close"></i></a>
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
                                            <th>Producto</th>
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
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>00001</td>
                                            <td>Producto X</td>
                                            <td>120.00</td>
                                            <td></td>
                                            <td>ZBC</td>
                                            <td>XYZ</td>
                                            <td>2</td>
                                            <td>Azul</td>
                                            <td>A</td>
                                            <td>AB</td>
                                            <td>Observación</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">1</th>
                                            <td>00001</td>
                                            <td>Producto X</td>
                                            <td>15.00</td>
                                            <td></td>
                                            <td>ZBC</td>
                                            <td>XYZ</td>
                                            <td>2</td>
                                            <td>Azul</td>
                                            <td>A</td>
                                            <td>AB</td>
                                            <td>Observación</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">1</th>
                                            <td>00001</td>
                                            <td>Producto X</td>
                                            <td>20.80</td>
                                            <td>002</td>
                                            <td>ZBC</td>
                                            <td>XYZ</td>
                                            <td>2</td>
                                            <td>Azul</td>
                                            <td>A</td>
                                            <td>AB</td>
                                            <td>Observación</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class=" col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success form-control">Registrar</button>
                                <button type="reset" class="btn btn-primary form-control">Cancelar</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">


            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Productos asociados</h4>
                </div>

                <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <br>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Serie</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>NumParte</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>12.80</td>
                                        <td></td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>14.60</td>
                                        <td></td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>20.00</td>
                                        <td>002</td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary form-control">Seleccionar</button>
                    <button type="button" class="btn btn-danger form-control" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            </div>
        </div>

    </div>
@endsection