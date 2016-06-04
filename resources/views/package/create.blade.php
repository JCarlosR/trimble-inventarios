@extends('layouts.panel')

@section('title', 'Paquetes')

@section('styles')
    <style>
        .typeahead,
        .tt-query,
        .tt-hint {
            line-height: 30px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            outline: none;
        }
        .typeahead:focus {
            border: 1px solid #0097cf;
        }
        .tt-query {
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }
        .tt-hint {
            color: #bdbdbd;
        }
        .tt-menu {
            margin: 12px 0;
            padding: 8px 0;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 4px;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
            box-shadow: 0 5px 10px rgba(0,0,0,.2);
            color: #000;
        }
        .tt-suggestion {
            padding: 3px 20px;
            line-height: 24px;
        }
        .tt-suggestion:hover {
            cursor: pointer;
            color: #fff;
            background-color: #0097cf;
        }
        .tt-suggestion.tt-cursor {
            color: #fff;
            background-color: #0097cf;
        }
        .tt-suggestion p {
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Registrar paquete</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br>
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label col-md-3" for="nombre">Código único:
                                    </label>
                                    <div class="input-group col-md-9">
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <label class="control-label col-md-3" for="Observacion">Observación: </label>
                                    <div class="input-group col-md-9">
                                        <textarea style="resize: none" id="comment" name="comment" rows="2" class="form-control"></textarea>
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

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <br>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Serie</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <template id="template-item">
                                            <tr>
                                                <td data-name>1000001</td>
                                                <td data-series>256314</td>
                                                <td>
                                                    <button data-delete type="button" class="btn btn-danger">Quitar</button>
                                                </td>
                                            </tr>
                                        </template>
                                        <tbody id="table-items">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-6 col-md-offset-5">
                            <a href="{{ url('paquete') }}" type="reset" class="btn btn-danger">Cancelar</a>
                            <button type="button" id="" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
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

        {{-- Fin modal --}}
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/package/package.js') }}"></script>
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