<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trimble Perú | Ingresar</title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body style="background:#F7F7F7;">

    <div id="wrapper">
        <div id="login" class=" form">
            <section class="login_content">
                <form role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}

                    <h1>Formulario de ingreso</h1>

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

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Recordar sesión
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-default submit" href="index.html">Ingresar</button>
                        <a class="reset_pass" href="{{ url('/password/reset') }}">Olvidó su contraseña?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Aún no se ha registrado?
                            <a href="{{ url('/register') }}"> Nueva cuenta </a>
                        </p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-battery-full" style="font-size: 26px;"></i> Trimble Perú</h1>
                            <p>©2016 Todos los derechos reservados. Trimble Perú. Privacy and Terms.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

    </div>

</body>
</html>