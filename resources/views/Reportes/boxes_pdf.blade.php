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
    <h1>Reporte de cajas</h1>
    <table>
        <thead>
            <tr>
                <th>Tipo de caja</th>
                <th>Placa</th>
                <th>Tamaño de caja</th>
                <th>Tipo de permiso</th>
            </tr>
        </thead>
        <tbody>
            @foreach($boxes as $b)
                <tr>
                    <td>{{ $b->box_type -> id }}</td>
                    <td>{{ $b->plate }}</td>
                    <td>{{ $b->box_size -> id }}</td>
                    <td>{{ $b->box_permit -> id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>