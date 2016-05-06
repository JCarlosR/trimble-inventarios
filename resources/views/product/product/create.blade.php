@extends('layouts.panel')

@section('title', 'Productos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Registrar producto</h2>
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
                            <label class="control-label col-md-3c col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="nombre" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="descripcion" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="last-name">Precio <span class="required">*</span>
                            </label>
                            <div class="col-md-3">
                                <input type="number" placeholder="0.00" step="0.01"  id="precio" name="last-name" required="required" class="form-control col-md-4 col-xs-12">
                            </div>

                            <div class="form-group form-inline">
                                <label class="control-label col-md-1" for="last-name">Serie <span class="required">*</span>
                                </label>
                                <div class="col-md-3 checkbox">
                                    <input type="checkbox" name="serie" value="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="last-name">Marca <span class="required">*</span>                            </label>
                            <div class="col-md-3">
                                <select name="marca" id="" class="form-control">
                                    <option value="1">Marca ABCD1</option>
                                    <option value="2">Marca ABCD2</option>
                                    <option value="3">Marca ABCD3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1" for="last-name">Modelo <span class="required">*</span>
                                </label>
                                <div class="col-md-2">
                                    <select name="modelo" id="" class="form-control">
                                        <option value="1">Modelo ABCD2</option>
                                        <option value="2">Modelo ABCD3</option>
                                        <option value="3">Modelo ABCD4</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Número de parte <span class="required">*</span>                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" id="numParte" name="last-name" required="required" class="form-control col-md-4 col-xs-12">
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="last-name">Color <span class="required">*</span>
                                </label>
                                <div class="col-md-2">
                                    <input type="text" id="last-name" name="color" required="required" class="form-control col-md-4 col-xs-12">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="control-label col-md-3" for="last-name">Categoría <span class="required">*</span>                                </label>
                            <div class="col-md-3">
                                <select name="categoria" id="" class="form-control">
                                    <option value="1">Categoría XYZW1</option>
                                    <option value="2">Catgoría XYZW2</option>
                                    <option value="3">Catgoría XYZW3</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-1" for="last-name">Subcategoría <span class="required">*</span>
                                </label>
                                <div class="col-md-2">
                                    <select name="subcategoria" id="" class="form-control">
                                        <option value="1">Subcategoría 1</option>
                                        <option value="2">Subcategoría 3</option>
                                        <option value="3">Subcategoría 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Observación<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="observacion" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="col-md-6 btn-group col-md-offset-5">
                            <button type="submit" class="btn btn-success btn-lg">Registrar</button>
                            <button type="reset" class="btn btn-danger btn-lg">Cancelar</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    <div>
@endsection
