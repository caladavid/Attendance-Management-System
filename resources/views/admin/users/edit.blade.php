@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="text-center mb-4">Editar empleado</h1>
@stop

@section('content')
<div class="container-xl">

    <form method="post" action="{{ route("admin.users.update", $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">Primer nombre</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Segundo nombre</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Correo</label>
                <input type="email" name="email" class="form-control " value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Número de teléfono</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
            </div>
        </div>

        <div class="form-group">
        <label for="password">Nueva Contraseña</label>
        <input type="password" name="password" class="form-control">
        <small class="form-text text-muted">Dejar en blanco si no desea cambiar la contraseña.</small>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmar Nueva Contraseña</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department_id">Departamentos</label>
                <select name="department_id" class="form-control" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $department->id == old('department_id', $user->department_id) ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="shift_id">Turnos</label>
                <select name="shift_id" class="form-control" required>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}"  {{ $shift->id == old('shift_id', $user->shift_id) ? 'selected' : '' }}>
                            {{ $shift->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Aceptar</button>
            <a class="btn btn-danger" href="{{ route("admin.users.index")}}">Cancelar</a>
        </div>

    </form>

</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
