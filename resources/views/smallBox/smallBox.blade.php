@extends('layouts.panel')

@section('title', 'Caja chica')

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
                    <h2>Ingreso de conceptos a la caja chica</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                    @if( $errors->count() > 0 )
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                <strong>Lo sentimos! </strong>Por favor revise los siguientes errores.
                                @foreach($errors->all() as $message)
                                    <p>{{$message}}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="x_content">
                        <br>
                        <div class="row">
                            <form id="form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="concept">Concepto</label>
                                        <input type="text" class="form-control" id="concept" name="concept" placeholder="Concepto">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Tipo de concepto</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="assign">Asignacion</option>
                                            <option value="input">Ingreso</option>
                                            <option value="output">Egreso</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="concept">Fecha</label>
                                        <input type="date" class="form-control" id="date" name="date" value="{{ $date }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="voucher">Comprobante</label>
                                        <input type="file" id="voucher" name="voucher" class="form-control" accept= "application/pdf, image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Monto</label>
                                        <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01">
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <button id="save" data-url="{{ url('/salidas/cliente') }}" class="btn btn-success">Guardar</button>
                                        <button id="cancel" data-url="{{ url('/salidas/cliente') }}" class="btn btn-danger">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listado de conceptos de caja chica según mes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <br>
                        <div class="row">

                            <div class="col-md-3">
                                <label for="selectYear">Seleccione año</label>
                                <select id="selectYear" class="form-control">
                                    <option value="2016">2016</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="selectMonth">Seleccione mes</label>
                                <select id="selectMonth" class="form-control">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Setiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <a id="btnExcel" href="{{ url('/excel/caja-chica') }}" class="btn btn-success btn-block">Exportar como Excel</a>
                                <a id="btnPDF" href="{{ url('/pdf/caja-chica') }}" class="btn btn-info btn-block">Exportar como PDF</a>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/smallBox/index.js') }}"></script>
@endsection
