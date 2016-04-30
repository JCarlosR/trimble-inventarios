@extends('layouts.panel')

@section('title', 'Salidas')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Salida por baja</h2>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Fecha
                                </label>
                                <div class=" input-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="date" name="date" class="form-control col-md-7 col-xs-12">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Tipo
                                </label>

                                <div class="input-group col-md-3 col-md-offset-3" >
                                    <input type="radio" id="last-name"  name="tipo" value="1" checked >Producto
                                    <input type="radio" id="last-name"  name="tipo" value="0" >Paquete
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Producto
                                </label>
                                <div class="input-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control " placeholder="Buscar producto ...">
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" data-toggle="modal" data-target="#myModal" type="button">Ver series</button>
                                    </span>
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
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">Dar de baja</button>
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
