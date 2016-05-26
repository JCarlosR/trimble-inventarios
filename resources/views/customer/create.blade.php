@extends('layouts.panel')

@section('title', 'Clientes')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Registrar nuevo cliente</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/clientes') }}">Ver listado</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if( $errors->count() > 0 )
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Lo sentimos! </strong>Por favor revise los siguientes errores.
                                    @foreach($errors->all() as $message)
                                        <p>{{$message}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <br>
                    <form action="{{ url('/clientes/registrar') }}" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="persona">Denominación Legal </label>
                                    <div>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default active">
                                                <input type="radio" id="Natural" name="persona" value="Natural" checked> Persona Natural
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" id="Juridica" name="persona" value="Juridica"> &nbsp;Persona Jurídica
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="address">Dirección / Dirección fiscal <span class="required">*</span></label>

                                    <input id="address"  class="form-control col-md-7 col-xs-12" type="text" name="address">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1 ">
                                <div class="form-group">
                                    <label for="name">Nombres Completos / Razón Social <span class="required">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">

                                </div>
                            </div>

                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label for="document">DNI / RUC / RUS <span class="required">*</span>
                                    </label>
                                    <input type="text" id="document" name="document" required="required" class="form-control col-md-7 col-xs-12">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="phone">
                                        Teléfono / Celular
                                    </label>
                                    <input name="phone" class="form-control col-md-7 col-xs-12" type="text">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="client_type_id" >
                                        Tipo de cliente <span class="required">*</span>
                                    </label>
                                    <div>
                                        <select name="types" class="form-control col-md-7 col-xs-12" required="required">
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="row">
                            <div class="col-md-3 col-md-offset-3 ">
                                <button type="submit" class="btn btn-success btn-block">Registrar</button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('/clientes') }}" class="btn btn-danger btn-block">Cancelar</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
