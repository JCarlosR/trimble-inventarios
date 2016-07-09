<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ventas - Trimble</title>
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
            <h4>Reporte de ventas entre el {{ $inicio }} y {{ $fin }} <br> Cliente: {{ $cliente }}</h4>
        </header>
    </center>
</div>
<div class="row">
    @foreach($outputs as $output)
            <table class ="margin">
                <thead >
                <tr>
                    <th align="center" style="color: #fff; background: #4919c9;">CLIENTE</th>
                    <th align="center" style="color: #fff; background: #4919c9;">FECHA VENTA</th>
                    <th align="center" style="color: #fff; background: #4919c9;">TIPO</th>
                    <th align="center"style="color: #fff; background: #4919c9;">TOTAL VENTA</th>
                    <th align="center" style="color: #fff; background: #4919c9;"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="center">{{ $cliente }}</td>
                    <td align="center">{{ $output->created_at }}</td>
                    <td align="center">@if( $output->type == 'local') local @else extranjero @endif</td>
                    <td align="center">{{ $total[$output->id] }}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>

        @if( count($output->packages)>0 )
            <table>
                <thead>
                <tr>
                    <th align="center" style="color: #fff; background: #9659c9;"></th>
                    <th align="center" style="color: #fff; background: #9659c9;">PAQUETE</th>
                    <th align="center" style="color: #fff; background: #9659c9;">CODIGO</th>
                    <th align="center" style="color: #fff; background: #9659c9;">UBICACION</th>
                    <th align="center" style="color: #fff; background: #9659c9;">PRECIO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($output->packages as $outputPackage)
                    <tr>
                        <td></td>
                        <td align="center"><b>{{ $outputPackage->package->name }}</b></td>
                        <td align="center"><b>{{ $outputPackage->package->code }}</b></td>
                        <td align="center"><b>{{ $outputPackage->package->box->full_name }}</b></td>
                        <td align="center"><b>{{ $outputPackage->price }}</b></td>
                    </tr>

                    <tr>
                        <th></th>
                        <th></th>
                        <th>PRODUCTO</th>
                        <th align="center">SERIE</th>
                        <th align="center">UBICACION</th>
                    </tr>

                    @foreach($outputPackage->package->items as $item)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>{{ $item->product->name }}</td>
                            <td align="center">{{ $item->series }}</td>
                            <td align="center">{{ $item->box->full_name}}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        @endif

        @if( count($output->items)>0 )
            <table>
                <thead>
                <tr>
                    <th>PRODUCTO</th>
                    <th align="center">SERIE</th>
                    <th align="center">UBICACION</th>
                    <th align="center">PRECIO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($output->items as $outputDetail)
                    <tr>
                        <td>{{ $outputDetail->item->product->name }}</td>
                        <td align="center">{{ $outputDetail->item->series }}</td>
                        <td align="center">{{ $outputDetail->item->box->full_name }}</td>
                        <td align="center">{{ $outputDetail->price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</div>

</body>
</html>
