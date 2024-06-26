<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Asistencia</title>
    <style>
        @import url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
    </style>
</head>

<body>
    <div>
        <h2 class="mb-2">Reporte de Asistencia</h2>
        @if($users->count())
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Turno</th>
                    <th>Hora del turno</th>
                    <th>Hora de registro</th>
                    <th>Hora de salida</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                    @foreach($user->attendances as $attendance)
                    <tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->department ? $user->department->name : 'No Asignado' }}</td>
                        <td>{{ $user->shift ? $user->shift->name : 'No Asignado' }}</td>
                        <td>
                            @if($user->shift)
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $user->shift->start_time)->format('h:i A') }} hasta {{ \Carbon\Carbon::createFromFormat('H:i:s', $user->shift->end_time)->format('h:i A') }}
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $attendance->time_in)->format('h:i A') }}
                        </td>
                        <td>
                            @if($attendance->time_out)
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $attendance->time_out)->format('h:i A') }}
                            @else
                            N/A
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        @else
        <p>No hay registros de asistencia disponibles.</p>
        @endif
    </div>
</body>

</html>