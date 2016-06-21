@extends('layouts.panel')

@section('title', 'Reportes')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de Existencias</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#">Settings 1</a>
                                </li>
                                <li>
                                    <a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Lo sentimos! </strong>Por favor revise los siguientes errores.
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    <div class="x_content">
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <select name="locals" id="locals" class="form-control">Locales
                                @foreach($locals as $local)
                                    <option value="{{ $local->name }}">{{ $local->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="shelves" id="shelves" class="form-control">Locales
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="levels" id="levels" class="form-control">Locales

                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="boxes" id="boxes" class="form-control">Locales
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <template id="template-item">
                                    <tr>
                                        <td data-name></td>
                                        <td data-series></td>
                                        <td data-quantity></td>
                                        <td data-location></td>
                                        <td data-state></td>
                                    </tr>
                                </template>
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Serie</th>
                                        <th>Cantidad</th>
                                        <th>Ubicación</th>
                                        <th>State</th>
                                    </tr>
                                    </thead>
                                    <tbody id="bodyItems">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/report/reportItems.js') }}"></script>
@endsection
