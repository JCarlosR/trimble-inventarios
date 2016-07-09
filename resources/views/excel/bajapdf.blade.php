<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bajas - Trimble</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Theme style -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .limitar {
            max-width: 100%;
        }
        body {font-family: Arial, Helvetica, sans-serif;}

        .margin
        {
            margin-top:20px;
        }

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin-left: 70px;
            width: 560px; text-align: left;
            border-collapse: collapse;
        }

        th {font-size: 13px;
            font-weight: normal;
            padding: 8px;
            background: #b9c9fe;
            border-top: 4px solid #aabcfe;
            border-bottom: 1px solid #fff;
            color: #039;
        }

        td {padding: 8px;
            background: #e8edff;
            border-bottom: 1px solid #fff;
            color: #669;
            border-top: 1px solid transparent;
        }

        tr:hover td { background: #d0dafd; color: #339; }
    </style>
</head>
<body>
<div class="row">
    <center>
        <img class="limitar" src="{{ asset('images/logo.jpg') }} " height="200" width="400"/>
        <header>
            <h2>TRIMBLE PERU SAC</h2>
            <h4>Reporte de productos y paquetes dados de baja entre el <br>{{ $inicio }} y {{ $fin }}</h4>
        </header>
    </center>
</div>
<div class="row">
    <table class="margin">
        <thead>
            <tr>
                <th align="center" style="color: #fff; background: #9659c9;">PAQUETE</th>
                <th align="center" style="color: #fff; background: #9659c9;">CODIGO</th>
                <th align="center" style="color: #fff; background: #9659c9;">UBICACION</th>
                <th align="center" style="color: #fff; background: #9659c9;">FECHA BAJA</th>
            </tr>
        </thead>
        <tbody>
        @foreach($packages as $package)
            <tr>
                <td align="center">{{ $package->name }}</td>
                <td align="center">{{ $package->code }}</td>
                <td align="center">{{ $package->box->full_name }}</td>
                <td align="center">{{ $package->updated_at }}</td>
            </tr>
            <tr>
                <th></th>
                <th>PRODUCTO</th>
                <th>SERIE</th>
                <th>UBICACION</th>
            </tr>

            @foreach($package->items as $item )
            <tr>
                <td></td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->series }}</td>
                <td>{{ $item->box->full_name }}</td>
            </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

    <table class="margin">
        <thead>
            <tr>
                <th>PRODUCTO</th>
                <th>SERIE</th>
                <th>UBICACION</th>
                <th>FECHA BAJA</th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
        <tr>
            <td align="center">{{ $item->product->name }}</td>
            <td align="center">{{ $item->series }}</td>
            <td align="center">{{ $item->box->full_name }}</td>
            <td align="center">{{ $item->updated_at }}</td>

        </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
