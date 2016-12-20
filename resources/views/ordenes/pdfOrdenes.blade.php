<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Órdenes de compra - Trimble</title>
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
                        <h3 class="sinpadding"><strong>NUMERO:</strong> <span> {{ $purchaseOrder->invoice }} </span></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="sinpadding"><strong>PROVEEDOR:</strong> <span> {{ $purchaseOrder->provider->name }} </span></h3>
                    </td>
                    <td>
                        <h3 class="sinpadding"><span><strong>FECHA:</strong> Lima, {{ $date }} </span></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="sinpadding"><span><strong>DIRECCIÓN:</strong> {{ $purchaseOrder->provider->address }} </span></h3>
                    </td>
                    <td>
                        <h3 class="sinpadding"><strong>DOC IDENTIDAD PROVEEDOR:</strong> <span> {{ $purchaseOrder->provider->document }} </span></h3>
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
                    <th>PRECIO</th>
                    <th>IGV</th>
                    <th>SUBTOTAL</th>
                </tr>
                </thead>
                <tbody>

                @foreach($purchaseOrder->details as $detail)
                <tr>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->originalprice }}</td>
                    <td>{{ $detail->igv }}</td>
                    <td>{{ $detail->subtotal }}</td>
                </tr>
                @endforeach
                <tr>
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
                </tr>

                <tr>
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
                    <td>{{ $reason }}</td>
                    <td>{{ $purchaseOrder->shipping }}</td>
                </tr>
                <tr>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>IGV {{ $reason }}</td>
                    <td>{{ $purchaseOrder->total-$purchaseOrder->shipping-$subtotal}}</td>
                </tr>
                <tr>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>{{ " " }}</td>
                    <td>TOTAL PAGAR</td>
                    <td>{{ $purchaseOrder->total }}</td>
                </tr>
                </tbody>
            </table>
        </div>



    </div>

</body>
</html>
