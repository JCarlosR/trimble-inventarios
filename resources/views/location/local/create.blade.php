@extends('layouts.panel')

@section('title', 'Locales')
@section('styles')
    <style>
        .no-resize
        {
            resize: none;
        }
        .inside:focus{
            border: 1px solid #0097cf;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Registrar local</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if( $errors->count() > 0 )
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                <strong>Lo sentimos!</strong> Por favor revise los siguientes errores.
                                @foreach($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <form id="form" class="form-horizontal form-label-left" method="post" action="{{ url('local/registrar') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" value="{{old('name')}}" required="required" class="form-control inside">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Observación
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control inside no-resize" rows="2" id="comment" name="comment">{{old('comment')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="type">Tipo<span class="required">*</span></label>
                            <div class="radio-group col-md-5">
                                @if( old('type') == 2)
                                    <input type="radio" id="type" name="type" value="1" >Almacén
                                    <input type="radio" id="type" name="type" value="2" checked>Oficina
                                @else
                                    <input type="radio" id="type" name="type" value="1" checked>Almacén
                                    <input type="radio" id="type" name="type" value="2">Oficina
                                @endif
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group text-center">
                            <a href="{{url('/local')}}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection