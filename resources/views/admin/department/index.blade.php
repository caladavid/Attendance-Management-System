@extends('adminlte::page')

@section('title', 'Departments')

@section('content')
<div>
    <div class="container p-2 lg-p-5">
        <div class="row">
            <div class="col-md-12">

                @if (session("status"))
                <div class="alert alert-success">{{ session("status") }}</div>
                @endif

                <div class="card">
                    <div class="card-header ">
                        <h4 class="d-flex justify-content-between ">Departamentos
                            <a class="btn btn-primary" href="{{ route("admin.departments.create")}}">Agregar departamento</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="15px">Id</th>
                                    <th scope="col">Nombre del departamento</th>
                                    <th scope="col" colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if($departments->count())
                                    @foreach ($departments as $department)
                                    <tr>
                                        <th scope="row">{{ $department->id }}</th>
                                        <td>{{ $department->name }}</td>
                                        <td width="10px">
                                            <a href="{{ route("admin.departments.edit", $department->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td width="10px">
                                            <form method="post" action="{{ route("admin.departments.destroy", $department->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Deseas eliminar este departamento?')"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center"><strong>No hay departamento registrado</strong></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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