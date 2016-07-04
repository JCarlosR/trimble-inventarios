@extends('layouts.panel')

@section('title', 'Productos y paquetes')

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
                    <h2>Listado de productos y paquetes de la caja {{$place->name}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content table-responsive">
                    <div class="col-md-9 form-inline">
                        <div class="col-md-8 input-group margen">
                            <span class="input-group-addon">Producto | Paquete</span><input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                        </div>

                        <div class="col-md-3 margen pull-right">
                            <a href="{{ url('caja/'.$level.'/'.$shelf.'/'.$local) }}" class="btn btn-success"><i class="fa fa-backward"></i> Volver</a>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>serie</th>
                            <!--<th>Opción</th>-->
                        </tr>
                        </thead>
                        <tbody id="tabla">
                        @foreach( $items as $item )
                            @if( $item->package_id == null)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->series }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    {!! $items->render() !!}

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Paquete</th>
                            <th>Opción</th>
                        </tr>
                        </thead>
                        <tbody id="tabla">
                        @foreach( $packages as $package )
                            <tr>
                                <td>{{ $package->code }}</td>
                                <td>{{ $package->name }}</td>
                                <td><button type="button" class="btn btn-primary" title="Ver contenido" data-look="{{ $package->id }}"><i class="fa fa-eye"> Contenido</i></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $packages->render() !!}

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


    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/location/box.js')}}"></script>
    <script src="{{ asset('js/location/search.js') }}"></script>
@endsection