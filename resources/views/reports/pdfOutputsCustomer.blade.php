<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Salidas - Trimble</title>
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
        body {font-family: Arial, Helvetica, sans-serif;}

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin: 22px;
            width: 480px; text-align: left;
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
        <img class="limitar" src="{{ asset('images/logo.jpg') }} " height="200" width="400"/>
        <header>
            <h2>TRIMBLE PERU SAC</h2>
            <h3>Reporte de salidas entre el {{ $start }} y {{ $end }} del cliente {{ $cliente }}</h3>
        </header>
    </div>
    <div class="row">
        @foreach($outputs as $output)
            <table>
                <thead>
                <tr>
                    <th>ID SALIDA</th>
                    <th>CLIENTE</th>
                    <th>TIPO</th>
                    <th>COMENTARIO</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $output->id }}</td>
                    <td>{{ $output->customers->name }}</td>
                    <td>{{ $output->reason }}</td>
                    <td>{{ $output->comment }}</td>
                </tr>
                </tbody>
            </table>

            <table>
                <thead>
                <tr>
                    <th>NOMBRE/PRODUCTO</th>
                    <th>CODIGO/SERIE</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>UBICACION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($output->items as $outputDetail)
                    <tr>
                        <td>{{ $outputDetail->item->product_name }}</td>
                        <td>{{ $outputDetail->item->series }}</td>
                        <td>1</td>
                        <td>{{ $outputDetail->price }}</td>
                        <td>{{ $outputDetail->item->current_location }}</td>
                    </tr>
                @endforeach
                @foreach($output->packages as $outputPackage)
                    <tr>
                        <td>PAQUETE</td>
                        <td>{{ $outputPackage->package->code }}</td>
                        <td>1</td>
                        <td>{{ $outputPackage->price }}</td>
                        <td>{{ $outputPackage->package->current_location}}</td>
                    </tr>

                    @foreach($outputPackage->package->items as $item)
                        <tr>
                            <th></th>
                            <th>NOMBRE/PRODUCTO</th>
                            <th>CODIGO/SERIE</th>
                            <th>CANTIDAD</th>
                            <th>UBICACION</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->series }}</td>
                            <td>1</td>
                            <td>{{ $item->current_location}}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>

</body>
</html>
