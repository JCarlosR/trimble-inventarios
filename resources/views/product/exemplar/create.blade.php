@extends('layouts.panel')

@section('title', 'Modelos')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Registrar modelo</h2>
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
                    <form id="demo-form2" method="post" action="{{url('modelo/registrar')}}"   class="form-horizontal form-label-left" n>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Marcas <span class="required">*</span>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="brand" id="" class="form-control">
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="col-md-6 col-sm-6 col-xs-12 btn-group col-md-offset-5">
                            <button type="submit" class="btn btn-success btn-lg">Registrar</button>
                            <a href="{{url('/modelo')}}" class="btn btn-danger btn-lg">Cancelar</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection