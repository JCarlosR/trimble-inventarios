@extends('layouts.panel')

@section('title', 'Marcas')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <h2>Listado de marcas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                     <div class="x_content">

                        <br>
                        <div class="input-group">
                            <h2><a href="{{ url('/marca/registrar') }}" class="btn btn-success btn-lg"><i class="fa fa-plus-square-o"></i> Nueva marca</a></h2>
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

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Marca</th>
                                <th>Descripción</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ str_limit($brand->name, $limit = 10, $end = '...') }}</td>
                                    <td>{{ str_limit($brand->description, $limit = 25, $end = '...') }}</td>
                                    <td>
                                        <button type="submit" class="btn btn-success" data-id="{{ $brand->id }}" data-name="{{ $brand->name }}"
                                                data-description="{{ $brand->description }} "> <i class="fa fa-pencil"></i>Editar
                                        </button>
                                        <button type="submit" class="btn btn-danger"  data-delete="{{ $brand->id }}" data-name="{{ $brand->name }}">
                                            <i class="fa fa-trash"></i>Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                         {!! $brands->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div id="modalEditar" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar marca</h4>
                </div>

                <form action="{{ url('marca/modificar') }}"  class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />

                        <div class="form-group">
                            <label for="nombres">Nueva marca</label>
                            <input type="text" class="form-control" name="name" required/>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Nueva descripción</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btn-group pull-left">
                            <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar marca</button>
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
                    <h4 class="modal-title">Eliminar marca</h4>
                </div>
                <form action="{{ url('marca/eliminar') }}" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label for="nombreEliminar">¿Desea eliminar la siguiente marca?</label>
                            <input type="text" readonly class="form-control" name="nombreEliminar"/>
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/products/brands.js')}}"></script>
@endsection
