<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Caja chica</title>
    <style>
        body {
            text-align: center;
        }
        .table {
            border-collapse: collapse !important;
        }
        .table td,
        .table th {
            background-color: #fff !important;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h1>CAJA CHICA - {{ $monthName }} {{ $year }}</h1>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Día</th>
                        <th>Concepto</th>
                        <th>Ingresos</th>
                        <th>Egresos</th>
                        <th>A favor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($movements as $movement)
                        <tr>
                            <td>{{ $movement[0] }}</td>
                            <td>{{ $movement[1] }}</td>
                            <td>{{ $movement[2] }}</td>
                            <td>{{ $movement[3] }}</td>
                            <td>{{ $movement[4] }}</td>
                            <td>{{ $movement[5] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>
</html>
