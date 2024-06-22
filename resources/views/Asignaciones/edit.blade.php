@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Actualizar Asignaciones</h1>
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
            <div class="card shadow">
                <div class="card-body">

                    @include('includes.alertas')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('asignaciones.update', $asig->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="usuario_id">Usuario</label>
                            <select name="usuario_id" id="usuario_id" class="form-control">
                                <option value="">{{ $asig->usuario->name }}</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                            @error('usuario_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="curso_id">Curso</label>
                            <select name="curso_id" id="curso_id" class="form-control">
                                <option value="">{{ $asig->curso->name }}</option>
                                @foreach ($cursos as $cur)
                                    <option value="{{ $cur->id }}">{{ $cur->name }}</option>
                                @endforeach
                            </select>
                            @error('curso_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $asig->nombre }}">
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" value="{{ $asig->fecha_inicio }}">
                            @error('fecha_inicio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha_finanlizacion">Fecha de Fin</label>
                            <input type="date" name="fecha_finalizacion" class="form-control" value="{{ $asig->fecha_finalizacion }}">
                            @error('fecha_fin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="importe">Importe</label>
                            <input type="number" name="importe" class="form-control" value="{{ $asig->importe }}">
                            @error('importe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success shadow">Actualizar</button> |
                            <a href="{{ url('/asignaciones') }}" class="btn btn-primary shadow">Volver al listado</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
