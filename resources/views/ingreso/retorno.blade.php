@extends('layouts.panel')

@section('title', 'Ingresos')

@section('styles')
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/typeahead.css') }}">
@endsection

@section('content')
    @if (session('notif'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Correcto!</strong> {{ session('notif') }}
        </div>
    @endif

    <div id="modalDevolutionPartial" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Devolución parcial</h4>
                </div>
                <template id="template-detail">
                    <tr>
                        <td data-name></td>
                        <td data-code></td>
                        <td data-price></td>
                        <td>
                            <input type="checkbox" name="" value="">
                        </td>
                    </tr>
                </template>
                <form action="{{ url('/ingreso/listar/retorno/parcial') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="output_id" id="output_id" value="">
                    <div class="modal-body">
                        <p>Listado de ítems y paquetes</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto / Paquete</th>
                                    <th>Código</th>
                                    <th>Precio</th>
                                    <th>¿Devolver?</th>
                                </tr>
                            </thead>
                            <tbody id="devolution-details">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Aplicar devolución</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ingreso por retorno</h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form id="form" class="form-horizontal form-label-left" novalidate="">
                        <!-- React JS -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendors/react/react.min.js') }}"></script>
    <script src="{{ asset('vendors/react/react-dom.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script>
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substrRegex;
                matches = [];
                substrRegex = new RegExp(q, 'i');
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });
                cb(matches);
            };
        };
    </script>
    <script src="{{ asset('js/entry/retorno-parcial.js')}}"></script>
    <script type="text/babel" src="{{ asset('js/entry/retorno.js')}}"></script>
@endsection
