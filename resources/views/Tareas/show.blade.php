@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Datos de la Tarea</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item active">Tarea</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <label for="asignacion_id">Asignación:</label>
                        <p>{{ $tarea->asignacion->nombre }}</p>

                        <label for="estudiante_id">Estudiante:</label>
                        <p>{{ $tarea->usuario->name }}</p>

                        <label for="descripcion">Descripción:</label>
                        <p>{!! $tarea->descripcion !!}</p>

                        <label for="entrega">Entrega:</label>
                        <p>{{\Carbon\Carbon::parse($tarea->entrega)->format('Y-m-d')}}</p>

                        <label for="nota">Nota:</label>
                        <p>{{ $tarea->nota }}</p>

                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ url('/tareas') }}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
