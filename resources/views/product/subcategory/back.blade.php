@extends('layouts.panel')

@section('title', 'Modelos')

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
                    <h2>Listado de modelos inactivos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content table-responsive">

                    <div class="col-md-3">
                        <h2><a href="{{ url('/subcategoria') }}" class="btn btn-success"><i class="fa fa-backward"></i> Subategorías activas</a></h2>
                    </div>

                    <div class="col-md-6 input-group margen">
                        <span class="input-group-addon">Subategoría</span><input type="text" id="search" class="form-control" placeholder="Búsqueda personalizada ...">
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Subcategoría</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody id="tabla">
                        @foreach($subcategories as $subcategory)
                            <tr>
                                <td>{{$subcategory->id}}</td>
                                <td>{{str_limit($subcategory->name, $limit = 10, $end = '...') }}</td>
                                <td>{{str_limit($subcategory->description, $limit = 15, $end = '...') }}</td>
                                <td>{{str_limit($subcategory->category->name, $limit = 20, $end = '...') }}</td>
                                <td>
                                    <span title="Activar">
                                        <button type="submit" class="btn btn-primary" data-habilitar="{{ $subcategory->id }}" data-name="{{ $subcategory ->name }}">
                                            <i class="fa fa-repeat"></i>
                                        </button>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $subcategories->render() !!}
                </div>
            </div>
        </div>

        <div id="modalHabilitar" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Habilitar subcategoría</h4>
                    </div>
                    <form action="{{ url('/subcategoria/habilitar') }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea habilitar la siguiente subcategoría?</label>
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