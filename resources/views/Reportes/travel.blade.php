<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte del viaje</title>
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


        .rounded-lg {
            border-radius: 10px;
        }

        .border {
            border: 2px solid #000;
        }

        .p-4 {
            padding: 4px;
        }

        .grid {
            display: grid;
        }

        .grid-cols-2 {
            grid-template-columns: repeat(3, 1fr);
        }

        .gap-4>* {
            margin-bottom: 16px;
        }

        p {
            font-size: 0.7em;
            /* Tamaño de fuente más pequeño */
        }
        .text-m {
            font-size: 0.8em;
            /* Tamaño de fuente más pequeño */
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('images/Logo.png') }}" width="100px" height="100px" alt="">
        <h1>Reporte del viaje</h1>
    </div>


    <div class="rounded-lg border p-4" style="margin-bottom: 10px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 33.33%;">
                    <p><strong>Fecha de factura:</strong> {{ $viaje->invoiceDate ?? '' }}</p>
                    <p><strong>Fecha de salida:</strong> {{ $viaje->departureDate ?? '' }}</p>
                    <p><strong>Hora de salida:</strong> {{ $viaje->departureTime ?? '' }}</p>
                    <p><strong>Fecha de regreso:</strong> {{ $viaje->returnDate ?? '' }}</p>
                    <p><strong>Hora de regreso:</strong> {{ $viaje->returnTime ?? '' }}</p>
                </td>
                <td style="width: 33.33%;">
                    <p><strong>Chofer:</strong> {{ ($viaje->user->name ?? '') . ' ' . ($viaje->user->paternalSurname ?? '') . ' ' . ($viaje->user->maternalSurname ?? '') }}</p>
                    <p><strong>Placa del tractor:</strong> {{ $viaje->tractor->plate ?? '' }}</p>
                    <p><strong>Tipo de carga:</strong> {{ $viaje->box_cargo->cargo ?? '' }}</p>
                    <p><strong>Tipo de caja:</strong> {{ $viaje->box_type->name ?? '' }}</p>
                    <p><strong>Placa de la caja:</strong> {{ $viaje->box->plate ?? '' }}</p>
                </td>
                <td style="width: 33.33%;">
                    <p><strong>Cantidad:</strong> {{ $viaje->quantity ?? '' }}</p>
                    <p><strong>Costo de flete:</strong> {{ $viaje->freightCost ?? '' }}</p>
                    <p><strong>Costo de casetas:</strong> {{ $viaje->boothCost ?? '' }}</p>
                    <p><strong>Gastos:</strong> {{ $viaje->expense ?? '' }}</p>
                    <p><strong>Kilómetros recorridos:</strong> {{ $viaje->kmTraveled ?? '' }}</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="rounded-lg border p-4">
        <table class="text-m">
            <thead>
                <tr>
                    <th>Numero de embarque</th>
                    <th>Destino</th>
                    <th>Direccion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($destinos as $destino)
                <tr>
                    <td class="p-4">{{$destino -> numberShipment}}</td>
                    <td class="p-4">{{$destino -> destination -> institution}}</td>
                    <td class="p-4">{{$destino -> destination -> state}}
    {{$destino -> destination -> zip_code}}
    {{$destino -> destination -> locality}}
    {{$destino -> destination -> neighborhood}}
    {{$destino -> destination -> street}}
    {{$destino -> destination -> number}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>