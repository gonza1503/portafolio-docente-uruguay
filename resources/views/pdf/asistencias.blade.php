<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencias</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 4px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte de Asistencias</h2>
    <table>
        <thead>
            <tr>
                <th>Grupo</th>
                <th>Alumno</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
            <tr>
                <td>{{ $asistencia->alumno->grupo->nombre }}</td>
                <td>{{ $asistencia->alumno->nombre }}</td>
                <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                <td>{{ $asistencia->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>