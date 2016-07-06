@extends('layouts.panel')

@section('title', 'Bienvenido')

@section('title-right')
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

            <form class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar producto ...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go</button>
                    </span>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <br>
                    <h1>
                        TRIMBLE PERÚ CORPORATION SAC
                    </h1>
                    <h3>
                        Sistema de Gestión de Inventarios
                    </h3>
                    <img class="img-responsive" src="{{ asset('images/bg.jpg') }}" alt="">
                </div>

            </div>
        </div>
    </div>
@endsection
