@extends('layouts.panel')

@section('title', 'Locales')

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
                    <h2>Listado de locales</h2>
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
                        <h2><a href="{{ url('local/registrar') }}" class="btn btn-success"><i class="fa fa-plus-square-o"></i> Nuevo local</a></h2>
                    </div>
                    <div class="col-md-9 form-inline">
                        <div class="col-md-9 input-group margen">
                            <span class="input-group-addon">Local</span><input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Observación</th>
                            <th>Opción</th>
                        </tr>
                        </thead>
                        <tbody id="tabla">
                        @foreach($locals as $local)
                            <tr>
                                <td>{{ $local->name }}</td>
                                <td>{{ $local->type==1?"Almacén":"Oficina"}}</td>
                                <td>{{ str_limit($local->comment, $limit = 50, $end = '...') }}</td>
                                <td>
                                    <a href="{{url('/anaquel/'.$local->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> Anaqueles</a>

                                    <button type="submit" class="btn btn-success" data-id="{{ $local->id }}" data-name="{{ $local->name }}"
                                            data-comment="{{ $local->comment }} " data-type="{{ $local->type }} ">
                                        <i class="fa fa-pencil"></i> Editar
                                    </button>

                                    <button type="submit" class="btn btn-danger"  data-delete="{{ $local->id }}" data-name="{{ $local->name }}">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $locals->render() !!}
                </div>
            </div>
        </div>

        <div id="modalEditar" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar local</h4>
                    </div>
                    <form action="{{ url('local/modificar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
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
                                        <label for="commet">Nueva observación</label>
                                        <textarea class="form-control inside no-resize" name="comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label for="type">Tipo</label>
                                        <div class="radio-group">
                                            <input type="radio" id="almacen" name="type" value="1" >Almacén
                                            <input type="radio" id="oficina" name="type" value="2" >Oficina</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="text-center">
                                <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Salir</button>
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar local</button>
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
                        <h4 class="modal-title">Eliminar local</h4>
                    </div>
                    <form action="{{ url('local/eliminar') }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea eliminar el siguiente local?</label>
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
    <script src="{{ asset('js/location/local.js')}}"></script>
    <script src="{{ asset('js/location/search.js') }}"></script>
@endsection
