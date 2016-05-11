@extends('layouts.panel')

@section('title', 'Salidas')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Salida por alquiler</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#">Settings 1</a>
                                </li>
                                <li>
                                    <a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="cliente">
                                            Cliente:
                                        </label>
                                        <div class="input-group col-md-9">
                                            <input id="cliente" name="cliente" class="typeahead form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="control-label col-md-3" for="tipo">Tipo:</label>

                                        <div class="input-group col-md-9">
                                            <input type="radio" name="tipo" value="local" checked>Local
                                            <input type="radio" name="tipo" value="foreign">Extranjero
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="control-label col-md-3" for="fecha">Retorno:</label>

                                        <div class="input-group col-md-9">
                                            <input type="date" name="fecha" class="form-control">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-6">
                                        <label class="control-label col-md-3" for="producto">Producto:
                                        </label>
                                        <div class="input-group col-md-9">
                                            <input type="text" id="producto" class="typeahead form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label col-md-4" for="cantidad">Cantidad:
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="number" min="1" step="1" id="cantidad" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label col-md-4" for="precio">Precio:
                                        </label>
                                        <div class="input-group col-md-8">
                                            <input type="number" min="0" step="0.01" id="precio" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Modal Header</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-hover table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Producto/Paquete</th>
                                                            <th>Serie</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>1000001</td>
                                                            <td>256314</td>
                                                            <td>
                                                                <button type="button" class="btn-success">Elegir</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>1000002</td>
                                                            <td>256314</td>
                                                            <td>
                                                                <button type="button" class="btn-success">Elegir</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td>1000003</td>
                                                            <td>256314</td>
                                                            <td>
                                                                <button type="button" class="btn-success">Elegir</button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="button" class="btn-primary form-control col-md-7 col-xs-12">Agregar a la lista</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lista</label>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Producto/Paquete</th>
                                            <th>Serie</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>1000001</td>
                                            <td>256314</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>
                                                <button type="button" class="btn-danger">Quitar</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>1000002</td>
                                            <td>256314</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>
                                                <button type="button" class="btn-danger">Quitar</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>1000003</td>
                                            <td>256314</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>
                                                <button type="button" class="btn-danger">Quitar</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Total
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="total" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <button type="submit" class="btn btn-danger">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
