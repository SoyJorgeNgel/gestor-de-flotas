<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: rgb(40, 94, 210);
            color: white;
            font-weight: bold;
            padding: 8px;
            text-align: left;
        }

        td, th {
            border: 1px solid #dddddd;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Reporte de tractores</h1>
    <table>
        <thead>
            <tr>
                <th>Numero de serial</th>
                <th>Modelo</th>
                <th>Plca</th>
                <th>Kilometraje</th>
                <th>Chofer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tractor as $t)
                <tr>
                    <td>{{ $t->serialNumber }}</td>
                    <td>{{ $t->truck_model->model ." ". $t->truck_model->year }}</td>
                    <td>{{ $t->plate }}</td>
                    <td>{{ $t->mileage }}</td>
                    <td>{{ $t->user->name . " " . $t->user->paternalSurname ." ". $t->user->maternalSurname }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>