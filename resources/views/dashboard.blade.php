@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container p-5">
    <div class="row">
        <div class="col-md-4 col-xl-4">
            <div class="card bg-primary">
                <div class="p-4">
                    <h5>Empleados</h5>
                    @php
                    use App\Models\User;
                    $count_employee = User::count();
                    @endphp
                    <h2 class="d-flex justify-content-between"><i class="fa fa-users f-left"></i><span>{{$count_employee}}</span></h2>
                    <p class="m-b-0 text-right"><a href="{{ route("admin.users.index") }}"" class=" text-white">Ver más</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="card bg-primary">
                <div class="p-4">
                    <h5>Departamentos</h5>
                    @php
                    use App\Models\Departments;
                    $count_departments = Departments::count();
                    @endphp
                    <h2 class="d-flex justify-content-between"><i class="fas fa-building f-left"></i><span>{{$count_departments}}</span></h2>
                    <p class="m-b-0 text-right"><a href="/admin/departments" class="text-white">Ver más</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="card bg-primary">
                <div class="p-4">
                    <h5>Turnos</h5>
                    @php
                    use App\Models\Shift;
                    $count_shift = Shift::count();
                    @endphp
                    <h2 class="d-flex justify-content-between"><i class="fas fa-building f-left"></i><span>{{$count_shift}}</span></h2>
                    <p class="m-b-0 text-right"><a href="/admin/departments" class="text-white">Ver más</a></p>
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
