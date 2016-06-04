@extends('layouts.panel')

@section('title', 'Paquetes')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Listado de paquetes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <br>
                    <div class="input-group">
                        <h2><a href="{{ url('/paquete/registrar') }}" class="btn btn-success"><i class="fa fa-plus-square-o"></i> Nuevo paquete</a></h2>
                    </div>
                    <br>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Paquete</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $packages as $package )
                                    <tr>
                                        <td>{{ $package->code }}</td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success" title="Ver contenido" data-look="{{ $package->id }}">
                                                <i class="fa fa-eye"> Contenido</i>
                                            </button>
                                            <button type="button" class="btn btn-primary" title="Editar">
                                                <i class="fa fa-pencil"> Editar</i>
                                            </button>
                                            <button type="button" class="btn btn-danger" title="Eliminar" data-delete="{{ $package->id }}">
                                                <i class="fa fa-trash"> Eliminar</i>
                                            </button>
                                        </td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $packages->render() !!}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalDetails" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Detalles del paquete</h4>
                    </div>
                    <div class="modal-body" id="bodyDetails">
                        <table class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Serie</th>
                            </tr>
                            </thead>
                            <template id="template-details">
                                <tr>
                                    <td data-name>1000001</td>
                                    <td data-series>256314</td>
                                    <td data-price>256314</td>
                                </tr>
                            </template>
                            <tbody id="table-details">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    </div>
                </div>

            </div>
        </div>

        {{-- Fin modal --}}

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/package/packageIndex.js') }}"></script>
@endsection