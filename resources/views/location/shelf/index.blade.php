@extends('layouts.panel')

@section('title', 'Anaqueles')

@section('styles')
    <style>
        .margen
        {
            margin-top:10px;
        }
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
                    <h2>Listado de anaqueles {{$place->type==1?'del almacén':'de la oficina'}} {{$place->name}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content table-responsive">

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

                    <div class="col-md-3">
                        <h2><a href="{{ url('anaquel/registrar/'.$local) }}" class="btn btn-success"><i class="fa fa-plus-square-o"></i> Nuevo anaquel</a></h2>
                    </div>
                    <div class="col-md-9 form-inline">
                        <div class="col-md-9 input-group margen">
                            <span class="input-group-addon">Anaquel</span><input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                        </div>

                        <div class="col-md-3 margen pull-right">
                            <a href="{{ url('/anaquel/eliminados') }}" class="btn btn-dark" type="button"><i class="fa fa-lock"></i> Restablecer eliminados</a>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Observación</th>
                            <th>Opción</th>
                        </tr>
                        </thead>
                        <tbody id="tabla">
                        @foreach($shelves as $shelf)
                            <tr>
                                <td>{{ $shelf->name }}</td>
                                <td>{{ str_limit($shelf->comment, $limit = 50, $end = '...') }}</td>
                                <td>
                                    <a href="{{url('/nivel/'.$shelf->id.'/'.$local)}}" class="btn btn-primary"><i class="fa fa-eye"></i> Niveles</a>

                                    <button type="submit" class="btn btn-success" data-id="{{ $shelf->id }}" data-name="{{ $shelf->name }}"
                                            data-comment="{{ $shelf->comment }} ">
                                        <i class="fa fa-pencil"></i>Editar
                                    </button>

                                    <button type="submit" class="btn btn-danger"  data-delete="{{ $shelf->id }}" data-name="{{ $shelf->name }}">
                                        <i class="fa fa-trash"></i>Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $shelves->render() !!}

                    <div class="form-group">
                        <div class="col-md-3">
                            <h2><a href="{{ url('local') }}" class="btn btn-success"><i class="fa fa-backward"></i> Volver</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalEditar" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar anaquel</h4>
                    </div>
                    <form action="{{ url('anaquel/modificar/'.$local) }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label for="name">Nuevo nombre</label>
                                        <input type="text" class="form-control inside" name="name" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label for="comment">Nueva observación</label>
                                        <textarea class="form-control inside no-resize" name="comment"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="text-center">
                                <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar anaquel</button>
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
                        <h4 class="modal-title">Eliminar anaquel</h4>
                    </div>
                    <form action="{{ url('anaquel/eliminar/'.$local) }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea eliminar el siguiente anaquel?</label>
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
    <script src="{{ asset('js/location/shelf.js')}}"></script>
    <script src="{{ asset('js/location/search.js') }}"></script>
@endsection
