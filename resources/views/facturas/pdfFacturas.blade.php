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
            font-size: 10px;

            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        th {font-size: 13px;
            font-weight: normal;
            padding: 4px;
            background: #b9c9fe;
            border-top: 4px solid #aabcfe;
            border-bottom: 1px solid #fff;
            color: #039;
        }

        td {padding: 4px;
            background: #e8edff;
            border-bottom: 1px solid #fff;
            color: #669;
            border-top: 1px solid transparent;
        }

        tr:hover td { background: #d0dafd; color: #339; }

        .contenido{
            position: relative;
            width: 700px;
            height: 700px;
            border-color: #0f0f0f;
            border-style: solid;
        }
        .cabecera{
            width: inherit;
            height: 210px;

        }
        .detalle{
            width: inherit;
            height: 490px;
        }
        .limitar {
            height: 105px;
            width: 105px;
        }
        .sinpadding{
            font-size: 10px !important;
            padding-top: 0;
            margin-top: 0.4em;
            margin-left: 1em;
            font-weight: normal!important;

        }
    </style>
</head>
<body>

    <div class="contenido">

        <div class="cabecera">
            <table>
                <tr>
                    <td rowspan="3">
                        <img class="limitar" src="{{ asset('images/logo.jpg') }}"/>
                    </td>
                    <td>
                        <h3 class="sinpadding"><strong>RUC:</strong> <span> 12345678909 </span></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="sinpadding"><span><strong>DOCUMENTO:</strong>  {{ $type_doc }}   </span></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="sinpadding"><strong>NUMERO:</strong> <span> {{ $output->invoice }} </span></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="sinpadding"><strong>CLIENTE:</strong> <span> {{ $output->customers->name }} </span></h3>
                    </td>
                    <td>
                        <h3 class="sinpadding"><span><strong>FECHA:</strong> Lima, {{ $date }} </span></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="sinpadding"><span><strong>DIRECCIÓN:</strong> {{ $output->customers->address }} </span></h3>
                    </td>
                    <td>
                        <h3 class="sinpadding"><strong>DOC IDENTIDAD CLIENTE:</strong> <span> {{ $output->customers->document }} </span></h3>
                    </td>
                </tr>
            </table>
        </div>
        <div class="detalle">

            <table>
                <thead>
                <tr>
                    <th>CANTIDAD</th>
                    <th>PRODUCTO</th>
                    <th>SERIE</th>
                    <th>PRECIO</th>
                    <th>IGV</th>
                    <th>SUBTOTAL</th>
                </tr>
                </thead>
                <tbody>

                @foreach($output->details as $outputDetail)
                <tr>
                    <td>{{ 1 }}</td>
                    <td>{{ $outputDetail->item->product->name }}</td>
                    <td>{{ $outputDetail->item->series }}</td>
                    <td>{{ $outputDetail->originalprice }}</td>
                    <td>{{ $outputDetail->price - $outputDetail->originalprice }}</td>
                    <td>{{ $outputDetail->price }}</td>
                </tr>

                @endforeach
                @foreach($output->packages as $outputPackage)
                    <tr>
                        <td>1</td>
                        <td>{{ $outputPackage->package->name }}</td>
                        <td>{{ $outputPackage->package->code }}</td>
                        <td>{{ $outputPackage->originalprice }}</td>
                        <td>{{ $outputPackage->price - $outputPackage->originalprice }}</td>
                        <td>{{ $outputPackage->price }}</td>
                    </tr>

                @endforeach
                <tr>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                </tr>
                <tr>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                </tr>

                <tr>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>SUBTOTAL</td>
                    <td>{{ $subtotal }}</td>
                </tr>
                <tr>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ $reason }}</td>
                    <td>{{ $output->shipping }}</td>
                </tr>
                <tr>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>IGV {{ $reason }}</td>
                    <td>{{ $output->total-$output->shipping-$subtotal}}</td>
                </tr>
                <tr>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>TOTAL PAGAR</td>
                    <td>{{ $output->total }}</td>
                </tr>
                </tbody>
            </table>
        </div>



    </div>

</body>
</html>
