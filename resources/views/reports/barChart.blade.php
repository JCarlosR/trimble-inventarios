@extends('layouts.panel');

@section('title','Productos con más items')

@section('style')
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-8 col-md-offset-2">
            <form action="{{ url('data_bar')  }}" method="GET" class="form-horizontal form-label-left">

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="name">Año</label>
                        <div class="col-md-9">
                            <select name="anio" id="anio" class="form-control">
                                <option value="0">Todos</option>
                                @foreach(  $years as $year )
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="name">Mes</label>
                        <div class="col-md-9">
                            <select name="mes" id="mes" class="form-control">
                                <option value="0">Todos</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary form-control" id="graficar">Graficar</button>
                </div>
            </form>

            <div class="form-group">
                <canvas id="canvas"></canvas>
                <!-- <progress id="animationProgress" max="1" value="0"></progress> -->
            </div>
        </div>
        <br>
        <br>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/report/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/report/barGraphic.js') }}"></script>
@endsection