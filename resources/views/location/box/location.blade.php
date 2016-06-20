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
                                <td><a href="{{url('/ubicacion/'.$box.'/'.$level.'/'.$shelf.'/'.$local)}}" class="btn btn-primary"><i class="fa fa-eye"></i> Productos</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $packages->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/location/box.js')}}"></script>
    <script src="{{ asset('js/location/search.js') }}"></script>
    <script>

    </script>
@endsection