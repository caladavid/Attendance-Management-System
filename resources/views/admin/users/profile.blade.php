@extends('adminlte::page')

@section('title', 'Departments')

@section('content')
<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header display-4"><strong>Perfil</strong></h4> 
                <div class="card-body p-4">
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px;">
                        <p class="my-auto"><strong>Id del empleado: </strong></p>
                        <p class="ml-4 my-auto  fw-bold fs-1">{{ $user->id }}</p>
                        <p class="my-auto"><strong>Primer nombre: </strong></p>
                        <p class="ml-4 my-auto">{{ $user->first_name }}</p>
                        <p class="my-auto"><strong>Segundo nombre: </strong></p>
                        <p class="ml-4 my-auto">{{ $user->last_name }}</p>
                        <p class="my-auto"><strong>Email: </strong></p>
                        <p class="ml-4 my-auto">{{ $user->email }}</p>
                        <p class="my-auto"><strong>Teléfono: </strong></p>
                        <p class="ml-4 my-auto">{{ $user->phone }}</p>
                        <p class="my-auto"><strong>Fecha de inicio: </strong></p>
                        <p class="ml-4 my-auto">{{ $user->joining_date }}</p>
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
