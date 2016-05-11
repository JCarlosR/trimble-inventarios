@extends('layouts.panel')

@section('title', 'Ingresos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ingreso por retorno</h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>

                    <div class="x_content">
                        <br>
                        <div class="input-group">
                            <a href="{{ url('/ingreso/retorno') }}" id="NvoIngreso" class="btn btn-success"><i class="fa fa-plus-square-o"></i>  Nuevo Ingreso</a>
                        </div>
                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label " for="cliente">
                                            Buscar cliente
                                        </label>
                                        <div class="input-group col-md-10">
                                            <input type="text" id="cliente" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label " for="cliente">
                                            Desde:
                                        </label>
                                        <div class="input-group col-md-3">
                                            <input type="date" id="cliente" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label " for="cliente">
                                            Hasta:
                                        </label>
                                        <div class="input-group col-md-3">
                                            <input type="date" id="cliente" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2 col-sm-12">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Prestamos</th>
                                            <th>Otro campo</th>
                                            <th>Fecha</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>1000001</td>
                                            <td>otro campo</td>
                                            <td>14/05/2016</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>1000002</td>
                                            <td>otro campo</td>
                                            <td>14/05/2016</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>1000003</td>
                                            <td>otro campo</td>
                                            <td>14/05/2016</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalles</label>
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
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>1000001</td>
                                            <td>256314</td>
                                            <td>1</td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>1000002</td>
                                            <td>256314</td>
                                            <td>1</td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>1000003</td>
                                            <td>256314</td>
                                            <td>1</td>
                                            
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            {{--
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">Retornar</button>
                                    <button type="submit" class="btn btn-danger">Cancelar</button>
                                </div>
                            </div>
                            --}}

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
