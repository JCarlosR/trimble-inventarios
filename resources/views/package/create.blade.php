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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="nombre" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción</label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="descripcion" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Producto: </label>
                            <div class="input-group col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="producto" class="typeahead form-control">
                            </div>

                        </div>

                        <div class=" btn-group col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-success">Agregar</button>
                                <button type="reset" class="btn btn-danger">Eliminar</button>
                        </div>


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <br>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Serie</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>NumParte</th>
                                            <th>Color</th>
                                            <th>Categoría</th>
                                            <th>SubCategoría</th>
                                            <th>Observación</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>00001</td>
                                            <td>Producto X</td>
                                            <td>120.00</td>
                                            <td></td>
                                            <td>ZBC</td>
                                            <td>XYZ</td>
                                            <td>2</td>
                                            <td>Azul</td>
                                            <td>A</td>
                                            <td>AB</td>
                                            <td>Observación</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">1</th>
                                            <td>00001</td>
                                            <td>Producto X</td>
                                            <td>15.00</td>
                                            <td></td>
                                            <td>ZBC</td>
                                            <td>XYZ</td>
                                            <td>2</td>
                                            <td>Azul</td>
                                            <td>A</td>
                                            <td>AB</td>
                                            <td>Observación</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">1</th>
                                            <td>00001</td>
                                            <td>Producto X</td>
                                            <td>20.80</td>
                                            <td>002</td>
                                            <td>ZBC</td>
                                            <td>XYZ</td>
                                            <td>2</td>
                                            <td>Azul</td>
                                            <td>A</td>
                                            <td>AB</td>
                                            <td>Observación</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class=" col-md-6 btn-group col-md-offset-5">
                            <button type="submit" class="btn btn-success btn-lg">Registrar</button>
                            <button type="reset" class="btn btn-danger btn-lg">Cancelar</button>
                        </div>


                    </form>
                </div>

            </div>
        </div>


        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">


            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Productos asociados</h4>
                </div>

                <div class="modal-body">
                    <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Serie</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>NumParte</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>12.80</td>
                                        <td></td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>14.60</td>
                                        <td></td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>00001</td>
                                        <td>Producto X</td>
                                        <td>20.00</td>
                                        <td>002</td>
                                        <td>ZBC</td>
                                        <td>XYZ</td>
                                        <td>2</td>
                                    </tr>
                                    </tbody>
                                </table>
                </div>

                <div class="modal-footer btn-group">
                    <button type="button" class="btn btn-primary btn-lg">Seleccionar</button>
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>

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
        var products = {!! $productos !!};

        $('#producto').typeahead(
                {
                    hint: true,
                    highlight: true,
                    minLength: 1
                },
                {
                    name: 'products',
                    source: substringMatcher(products)
                }
        );



    </script>

@endsection