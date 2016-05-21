@extends('layouts.panel')

@section('title', 'Dashboard')

@section('title-right')
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar clientes ...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Proveedores</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/proveedores/registrar') }}">Nuevo proveedor</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>
                <div class="input-group">
                    <a href="{{ url('/proveedores/registrar') }}" id="NvoIngreso" class="btn btn-success"><i class="fa fa-plus-square-o"></i>  Nuevo proveedor</a>
                </div>
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
                <div class="x_content">

                    <br>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1 col-sm-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Direccion</th>
                                            <th>Género</th>
                                            <th>Teléfono</th>
                                            <th>Tipo</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $proveedores as $proveedor)
                                        <tr>
                                            <td>{{ $proveedor->name }}</td>
                                            <td>{{ $proveedor->surname }}</td>
                                            <td>{{ $proveedor->address }}</td>
                                            <td>{{ $proveedor->gender }}</td>
                                            <td>{{ $proveedor->phone }}</td>
                                            <td>{{ $proveedor->provider_type->name }}</td>
                                            <td>

                                                <button type="button" class="btn btn-primary" data-id="{{ $proveedor->id }}"
                                                        data-name="{{ $proveedor->name }}"
                                                        data-surname="{{ $proveedor->surname }}"
                                                        data-address="{{ $proveedor->address }}"
                                                        data-gender="{{ $proveedor->gender }}"
                                                        data-phone="{{ $proveedor->phone }}"
                                                        data-typeId="{{ $proveedor->provider_type->id }}"><i class="fa fa-pencil"></i></button>
                                                <button type="button"  class="btn btn-danger" data-delete="{{ $proveedor->id }}" data-name="{{ $proveedor->name }}"><i class="fa fa-trash"></i></button>

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
                    <h4 class="modal-title">Editar proveedor</h4>
                </div>

                <form action="{{ url('proveedores/modificar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
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
                            <label for="surname">Apellidos <span class="required">*</span></label>
                            <div>
                                <input type="text" id="surname" name="surname" required="required" class="form-control col-md-7 col-xs-12">
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
                            <label for="gender">Género</label>
                            <div>
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="radio" name="gender" id="Masculino" value="Masculino" checked> Hombre
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="gender" id="Femenino" value="Femenino"> &nbsp;Mujer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last-name">Tipo <span class="required">*</span></label>
                            <div>
                                <select id="types" name="types" class="form-control">
                                    @foreach($types as $type)
                                        <option id="{{ $type->id }}" value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="btn-group pull-left">
                            <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar producto</button>
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
                    <h4 class="modal-title">Eliminar proveedor</h4>
                </div>
                <form action="{{ url('/proveedores/eliminar') }}" method="POST">
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
    <script src="{{ asset('js/provider/provider-index.js')}}"></script>
@endsection
