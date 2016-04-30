@extends('layouts.panel')

@section('title', 'Ingresos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ingreso por compra</h2>
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
                        <form id="demo-form2" class="form-horizontal form-label-left" novalidate>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Buscar proveedor
                                </label>
                                <div class="input-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="proveedor" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Fecha
                                </label>
                                <div class=" input-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="date" name="date" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Tipo
                                </label>

                                <div class="input-group col-md-3 col-md-offset-3" >
                                    <input type="radio" id="last-name"  name="tipo" value="1" checked >Local
                                    <input type="radio" id="last-name"  name="tipo" value="0" >Extranjero
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Observación
                                </label>
                                <div class=" input-group col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="observacion" class="form-control col-md-7 col-xs-12" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Producto
                                </label>
                                <div class=" input-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="observacion" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Cantidad
                                </label>
                                <div class="input-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" min="0" step="1" id="observacion" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="button" class="btn btn-primary btn-block">Agregar a la lista</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2 col-sm-12">
                                    <p>Lista de productos</p>
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
                                                <button type="button" class="btn btn-danger">Quitar</button>
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
                                                <button type="button" class="btn btn-danger">Quitar</button>
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
                                                <button type="button" class="btn btn-danger">Quitar</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-xs-12" for="cliente">Total
                                </label>
                                <div class="input-group col-md-6 col-xs-12">
                                    <input type="text" id="total" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <button type="reset" class="btn btn-danger">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
