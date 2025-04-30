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
    <h1>Reporte de usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->paternalSurname }}</td>
                    <td>{{ $user->maternalSurname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>