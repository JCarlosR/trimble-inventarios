@extends('layouts.panel')

@section('title', 'Tipos de proveedor')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Registrar nuevo tipo de proveedor</h2>
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
                    <form method="post" action="{{ url('/proveedores/tipos/registrar') }}" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="name">Nombre <span class="required">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">

                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="description" >Descripción <span class="required">*</span>
                                    </label>
                                    <input type="text" id="description" name="description" required="required" class="form-control col-md-7 col-xs-12">

                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-3 ">
                                <button type="submit" class="btn btn-success btn-block">Registrar</button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('/proveedores') }}" class="btn btn-danger btn-block">Cancelar</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Tipos de proveedor</h2>
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

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2 col-sm-12">
                                <p>Listado de tipos de proveedor</p>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $providerTypes as $providerType)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $providerType->name }}</td>
                                            <td>{{ $providerType->description }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-id="{{ $providerType->id }}"
                                                        data-name="{{ $providerType->name }}"
                                                        data-description="{{ $providerType->description }}"><i class="fa fa-pencil"></i></button>
                                                <button type="button"  class="btn btn-danger" data-delete="{{ $providerType->id }}" data-name="{{ $providerType->name }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="modalEditar" class="modal fade in">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar tipo proveedor</h4>
                </div>

                <form action="{{ url('/proveedores/tipos/modificar') }}" class="form-horizontal form-label-left"  method="POST" >
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />

                        <div class="form-group">
                            <label for="name">Nombre <span class="required">*</span></label>
                            <div>
                                <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción <span class="required">*</span></label>
                            <div>
                                <input type="text" id="description" name="description" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="btn-group pull-left">
                            <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar proveedor</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modalEliminar" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar tipo de proveedor</h4>
                </div>
                <form action="{{ url('/proveedores/tipos/eliminar') }}" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label for="nombreEliminar">¿Desea eliminar el siguiente proveedor?</label>
                            <input type="text" readonly class="form-control" id="nombreEliminar" name="nombreEliminar"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group pull-left">
                            <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Cancelar</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Aceptar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/provider-type/provider-type.js')}}"></script>
@endsection
