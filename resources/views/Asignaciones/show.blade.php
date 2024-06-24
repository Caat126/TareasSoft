@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Datos de la Asignación</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item active">Asignaciones</li>
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

                        <label for="user_id">Usuario:</label>
                        <p>{{ $asig->usuario->name }}</p>

                        <label for="curso_id">Curso:</label>
                        <p>{{ $asig->curso->name }}</p>

                        <label for="nombre">Nombre</label>
                        <p>{{ $asig->nombre }}</p>

                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <p>{{\Carbon\Carbon::parse($asig->fecha_inicio)->format('Y-m-d')}}</p>

                        <label for="fecha_finalizacion">Fecha de Finalización</label>
                        <p>{{\Carbon\Carbon::parse($asig->fecha_finalizacion)->format('Y-m-d')}}</p>

                        <label for="importe">Importe</label>
                        <p>{{ $asig->importe }} Bs</p>

                        <label for="estado">Estado</label>
                        <p>
                            @if ($asig->estado == true)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">Inactivo</span>
                            @endif
                        </p>

                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ url('/asignaciones') }}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
