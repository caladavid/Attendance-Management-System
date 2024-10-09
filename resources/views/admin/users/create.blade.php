@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="text-center mb-4">Agregar empleado</h1>
@stop

@section('content')
<div class="container-xl">

    <form action="{{ route("admin.users.store") }}" method="post">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Primer nombre</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label>Segundo nombre</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Correo</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label>Número de teléfono</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Departamentos</label>
                <select name="department_id" class="form-control" required>
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Turnos</label>
                <select name="shift_id" class="form-control" required>
                    @foreach ($shifts as $shift)
                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                    @endforeach
                </select>
            </div>

<!--             <div class="form-group">
                <label>Roles</label>
                <div>
                    @foreach ($roles as $role)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role{{ $role->id }}">
                        <label class="form-check-label" for="role{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div> -->
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