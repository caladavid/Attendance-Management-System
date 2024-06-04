@extends('adminlte::page')

@section('title', 'Registrar horas')

@section('content')
<div class="container p-5">

    <div class="card ">
        <div class="card-body">
            <div>
                <h5 class="display-4"><strong>Registro de asistencia</strong></h5>

                @if (session('status'))
                <div class="alert alert-success my-2">
                    {{ session('status') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger my-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col ">
                    @if ($shift)
                    <div class="container py-4">
                        <div class="row ">
                            <div class="col">
                                
                            </div>
                            <div class="col col-sm-8 ">
                                <h3><strong id="currentTime">{{ $currentTime }}</strong></h3>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col ">
                                <p>Turno Actual:</p>
                            </div>
                            <div class="col col-sm-8">
                                <p>{{ $shift->name }}</p>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col">
                                <p>Inicio del Turno:</p>
                            </div>
                            <div class="col col-sm-8 ">
                                <p>{{ \Carbon\Carbon::createFromFormat('H:i:s', $shift->start_time)->format('h:i A') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Fin del Turno:</p>
                            </div>
                            <div class="col col-sm-8 ">
                                <p>{{ \Carbon\Carbon::createFromFormat('H:i:s', $shift->end_time)->format('h:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center ">
                        <form action="{{ route('attendance.time_in') }}" method="post" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success">Marcar Entrada</button>
                        </form>

                        <form action="{{ route('attendance.time_out') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger ml-5">Marcar Salida</button>
                        </form>
                    </div>

                    @else
                    <div class="py-2">
                        <p>No tienes un turno asignado.</p>
                    </div>
                    @endif


                </div>
            </div>

        </div>

        @stop

        @section('css')
        {{-- Add here extra stylesheets --}}
        {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
        @stop

        @section('js')
        <script>
            function updateTime() {
                const currentTimeElement = document.getElementById('currentTime');
                const now = new Date();
                let hours = now.getHours();
                const minutes = now.getMinutes();
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                const minutesStr = minutes < 10 ? '0' + minutes : minutes;
                const strTime = hours + ':' + minutesStr + ' ' + ampm;
                currentTimeElement.textContent = strTime;
            }

            setInterval(updateTime, 1000);
            updateTime();
        </script>
        @stop