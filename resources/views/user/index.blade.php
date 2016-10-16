@extends('layouts.panel')

@section('title', 'Usuarios')

@section('styles')
    <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listado de usuarios</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                @if( $errors->count() > 0 )
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                <strong>Lo sentimos! </strong>Por favor revise los siguientes errores.
                                @foreach($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="x_content">
                    <div class="row" id="container" data-url="{{ url('/') }}">
                        <!-- React JS -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="modalEditar" class="modal fade in">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar usuario</h4>
                </div>

                <form action="{{ url('clientes/modificar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />

                        <div class="form-group">
                            <label for="name">Nombre Completo / Razón Social <span class="required">*</span></label>
                            <div>
                                <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="document">Documento de Identificación <span class="required">*</span></label>
                            <div>
                                <input type="text" id="document" name="document" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Dirección <span class="required">*</span></label>
                            <div>
                                <input type="text" id="address" name="address" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Teléfono <span class="required">*</span></label>
                            <div>
                                <input type="text" id="phone" name="phone" value="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="persona">Denominación Legal </label>
                            <div>
                                <div id="persona" class="btn-group" data-toggle="buttons">
                                    <label data-clase class="btn btn-default">
                                        <input type="radio" name="persona" id="Natural" value="Natural" checked> Persona Natural
                                    </label>
                                    <label data-clase class="btn btn-default">
                                        <input type="radio" name="persona" id="Juridica" value="Juridica" > &nbsp;Persona Jurídica
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last-name">Tipo <span class="required">*</span></label>
                            <div>
                                <select id="types" name="types" class="form-control">
                                    {{--@foreach($tipos as $tipo)--}}
                                        {{--<option id="{{ $tipo->id }}" value="{{ $tipo->id }}">{{ $tipo->name }}</option>--}}
                                    {{--@endforeach--}}
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="btn-group pull-left">
                            <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar cliente</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendors/react/react.min.js') }}"></script>
    <script src="{{ asset('vendors/react/react-dom.min.js') }}"></script>
    <script src="{{asset('js/browser.min.js') }}"></script>
    <script type="text/babel" src="{{ asset('js/user/index.js')}}"></script>
@endsection
