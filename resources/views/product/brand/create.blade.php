@extends('layouts.panel')

@section('title', 'Marcas')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Registrar marca</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if( $errors->count() > 0 )
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Lo sentimos!</strong> Por favor revise los siguientes errores.
                                    @foreach($errors->all() as $message)
                                        <p>{{ $message }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <form id="demo-form2"  class="form-horizontal form-label-left" method="post" action=" {{url('marca/registrar')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" required="required" value="{{old('name')}}" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Descripción
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" rows="2" class="form-control">{{old('description')}}</textarea>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-lg">Registrar</button>
                            <a href="{{url('/marca')}}" class="btn btn-danger btn-lg">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection