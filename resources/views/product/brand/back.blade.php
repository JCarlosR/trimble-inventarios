@extends('layouts.panel')

@section('title', 'Marcas')

@section('styles')
    <style>
        .margen
        {
            margin-top:11px;
        }
        .no-resize
        {
            resize: none;
        }
        .inside:focus{
            border: 1px solid #0097cf;
        }
        .image
        {
            height: 40px;
            width: 40px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Listado de marcas inactivas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content table-responsive">

                    <div class="col-md-3">
                        <h2><a href="{{ url('/marca') }}" class="btn btn-success"><i class="fa fa-backward"></i> Marcas activas</a></h2>
                    </div>

                    <div class="col-md-6 input-group margen">
                        <span class="input-group-addon">Marca</span><input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Marca</th>
                            <th>Descripción</th>
                            <th>Activar</th>
                        </tr>
                        </thead>
                        <tbody id="tabla">
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ str_limit($brand->name, $limit = 10, $end = '...') }}</td>
                                <td>{{ str_limit($brand->description, $limit = 25, $end = '...') }}</td>
                                <td>
                                    <span title="Activar">
                                        <button type="submit" class="btn btn-primary" data-habilitar="{{ $brand->id }}" data-name="{{ $brand ->name }}">
                                            <i class="fa fa-repeat"></i>
                                        </button>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $brands->render() !!}
                </div>
            </div>
        </div>

        <div id="modalHabilitar" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Habilitar marca</h4>
                    </div>
                    <form action="{{ url('/marca/habilitar') }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea habilitar la siguiente marca?</label>
                                <input type="text" readonly class="form-control" name="nombreHabilitar"/>
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
    <script src="{{ asset('js/products/enable.js') }}"></script>
    <script src="{{ asset('js/products/search.js') }}"></script>
@endsection