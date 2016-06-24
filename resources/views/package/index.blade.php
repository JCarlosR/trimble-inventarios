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
                                        <th>Ubicación</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $packages as $package )
                                    <tr>
                                        <td>{{ $package->code }}</td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->box->full_name}}</td>
                                        <td>{{ $package->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success" title="Ver contenido" data-look="{{ $package->id }}">
                                                <i class="fa fa-eye"> Contenido</i>
                                            </button>
                                            <button type="button" class="btn btn-primary" title="Editar" data-edit="{{ $package->id }}"
                                                    data-code="{{$package->code}}" data-name="{{ $package->name }}" data-location="{{$package->box->full_name}}"
                                                    data-descripcion = "{{$package->description}}">
                                                <i class="fa fa-pencil"> Editar</i>
                                            </button>
                                            <button type="button" class="btn btn-danger" title="Descomponer" data-delete="{{ $package->id }}" data-name="{{ $package->name }}">
                                                <i class="fa fa-trash"> Descomponer</i>
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

        <div class="modal fade" id="modalEdit" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar paquete</h4>
                    </div>
                    <div class="modal-body" id="bodyDetails">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label col-md-3" for="nombre">Nombre:</label>
                                    <div class="input-group col-md-9">
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="code">Código único:</label>
                                        <div class="input-group col-md-9">
                                            <input type="text" id="code" name="code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label typeahead col-md-3" for="code">Ubicación:</label>
                                        <div class="input-group col-md-9">
                                            <input type="text" id="location" name="location" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <label class="control-label col-md-3" for="Observacion">Observación: </label>
                                    <div class="input-group col-md-9">
                                        <textarea style="resize: none" id="description" name="description" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-2">
                                    <label class="control-label col-md-3" for="product">Producto: </label>
                                    <div class="input-group col-md-9">
                                        <input type="text" id="product" class="typeahead form-control">
                                    </div>
                                </div>

                                <div class="col-md-2 ">
                                    <button type="button" id="btnAdd" class="btn btn-primary">Agregar</button>
                                </div>
                            </div>
                        </div>

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
                        <div class="text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                            <button class="btn btn-success">Registrar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Modal -->
        <template id="template-series">
            <div class="form-group">
                <label for="serie">Ingrese serie:</label>
                <input type="text" class="typeahead form-control" data-search>
            </div>
        </template>

        <div class="modal fade" id="modalSeries" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ingrese las series</h4>
                    </div>
                    <div class="modal-body" id="bodySeries">

                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" id="btnAccept">Aceptar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="modalDescomponer" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Descomponer paquete</h4>
                    </div>
                    <form action="{{ url('paquete/descomponer') }}" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" id="id" />
                            <div class="form-group">
                                <label for="nombreEliminar">¿Desea descomponer el siguiente paquete?</label>
                                <input type="text" readonly class="form-control" name="name"/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group pull-left">
                                <button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-menu-up"></span> Cancelar</button>
                            </div>
                            <div class="btn-group pull-right">
                                <button type="submit" id="sayYes" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Aceptar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/package/package_table.js') }}"></script>
    <script src="{{ asset('js/package/packageIndex.js') }}"></script>
    <script>

        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };
    </script>
@endsection