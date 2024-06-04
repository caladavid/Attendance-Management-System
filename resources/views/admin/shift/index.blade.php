@extends('adminlte::page')

@section('title', 'Turnos')

@section('content')
<div class="container p-2 lg-p-5">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">

                @if (session("status"))
                <div class="alert alert-success">{{ session("status") }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="d-flex justify-content-between">Turnos
                            <a class="btn btn-primary" href="{{ route("admin.shift.create")}}">Agregar turnos</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre del turno</th>
                                    <th scope="col">Hora de inicio</th>
                                    <th scope="col">Hora de salida</th>
                                    <th scope="col" colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            @if($shifts->count())
                                @foreach ($shifts as $shift)
                                <tr>
                                    <th scope="row">{{ $shift->id }}</th>
                                    <td>{{ $shift->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($shift->start_time)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($shift->end_time)->format('h:i A') }}</td>
                                    <td width="10px">
                                        <a href="{{ route("admin.shift.edit", $shift) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route("admin.shift.destroy", $shift) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Deseas eliminar este turno?')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center"><strong>No hay turno registrado</strong></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@stop


@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="https://kit.fontawesome.com/128745fb3a.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@stop