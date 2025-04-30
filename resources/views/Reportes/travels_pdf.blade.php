<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de usuarios</title>
    <style>
        .header {
            text-align: center;
            padding-bottom: 1em;
        }

        .header img {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        .header h1 {
            display: inline-block;
            vertical-align: middle;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            text-align: center;
        }


        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: rgb(30, 58, 138);
            color: white;
            font-weight: bold;
            padding: 8px;
            text-align: left;
        }

        td,
        th {
            border: 1px solid #dddddd;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('images/Logo.png') }}" width="100px" height="100px" alt="">
        <h1>Reporte de viajes</h1>
    </div>


    <table>
        <thead>
            <tr>
                <th>Salida</th>
                <th>Fecha de factura</th>
                <th>Salida</th>
                <th>Retorno</th>
                <th>Chofer</th>
                <th>Tractor</th>
                <th>Tipo de carga</th>
                <th>Tipo de caja</th>
                <th>Caja</th>
                <th>Cantidad</th>
                <th>Gastos</th>
                <th>Km recorridos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($travels as $t)
            <tr>
                <td>{{ $t->departure -> departure }}</td>
                <td>{{ $t -> invoiceDate }}</td>
                <td>{{ $t -> departureDate ." a las ". $t -> departureTime ." HRS "}}</td>
                <td>{{ $t -> returnDate ." a las ". $t -> returnTime }}</td>
                <td>{{ $t->user->name ." ".$t->user->paternalSurname ." ".$t->user->maternalSurname }}</td>
                <td>{{ $t-> tractor -> plate }}</td>
                <td>{{ $t-> box_cargo->cargo }}</td>
                <td>{{ $t-> box_type->name }}</td>
                <td>{{ $t-> box -> plate }}</td>
                <td>{{ $t-> quantity }}</td>
                <td>${{ $t-> expense}}</td>
                <td>{{ $t-> kmTraveled }}</td>



            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>