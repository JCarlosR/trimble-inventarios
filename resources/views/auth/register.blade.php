<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trimble Perú | Registro</title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body style="background:#F7F7F7;">

<div id="wrapper">
    <div id="login" class="form">
        <section class="login_content">

            <form role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}

                <h1>Formulario de registro</h1>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre">

                    @if ($errors->has('name'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail">

                    @if ($errors->has('email'))
                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" autocomplete="new-password" placeholder="Contraseña">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                    @endif
                </div>

                <div>
                    <button type="submit" class="btn btn-default submit">Registrar</button>
                    <a class="reset_pass" href="{{ url('/login') }}">Ya se ha registrado?</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <br />
                    <h1><i class="fa fa-battery-full" style="font-size: 26px;"></i> Trimble Perú</h1>
                    <p>©2016 Todos los derechos reservados. Trimble Perú. Privacy and Terms.</p>
                </div>

            </form>
        </section>
    </div>

</div>

</body>
</html>