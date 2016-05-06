@extends('layouts.panel')

@section('title', 'Subcategorías')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Registrar subcategoría</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Categorías <span class="required">*</span>
                            </label>
                            <div class="radio col-md-6 col-sm-6 col-xs-12">
                                <select name="" id="" class="form-control">
                                    <option value="1">Categoría ABCD1</option>
                                    <option value="2">Categoría ABCD2</option>
                                    <option value="3">Categoría ABCD3</option>
                                </select>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="col-md-6 col-sm-6 col-xs-12 btn-group col-md-offset-5">
                            <button type="submit" class="btn btn-success btn-lg">Registrar</button>
                            <button type="reset" class="btn btn-danger btn-lg">Cancelar</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
