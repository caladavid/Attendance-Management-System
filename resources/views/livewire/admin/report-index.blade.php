<div class="card">
    <div class="card-header ">
        <h4 class="d-flex justify-content-between py-2">Reporte de Asistencia</h4>
        <form action="{{ route('admin.download-pdf') }}" method="GET" target="_blank">
            <div class="form-group">
                <label for="startDate">Fecha Desde:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="endDate">Fecha Hasta:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Descargar PDF</button>
        </form>
    </div>
    <div class="card-body">

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Fecha</th>
                    <th>Turno</th>
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
                    <td>{{ $attendance->date }}</td>
                    <td>
                        @if($user->shift)
                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $user->shift->start_time)->format('h:i A') }} hasta {{ \Carbon\Carbon::createFromFormat('H:i:s', $user->shift->end_time)->format('h:i A') }}
                        @else
                        No Asignado
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $attendance->time_in)->format('h:i A') }}</td>
                    <td>
                        @if($attendance->time_out)
                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $attendance->time_out)->format('h:i A') }}
                        @else
                        No Registrado
                        @endif
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>

</div>
</div>
</div>