@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content')
<div class="container p-5">
        <div class="row">
            <div class="col-md-12">

                @if (session("status"))
                <div class="alert alert-success">{{ session("status") }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Agregar departamento

                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("admin.departments.store") }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nombre del turno</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                @error("name") <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                                <a class="btn btn-danger" href="{{ route("admin.users.index")}}">Cancelar</a>
                            </div>
                        </form>
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
