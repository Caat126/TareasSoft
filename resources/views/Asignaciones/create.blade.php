@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Crear Asignaciones</h1>
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
        <div class="col-6">
            <div class="card shadow">
                <div class="card-body">

                    @include('includes.alertas')

                    <form action="{{ route('asignaciones.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="usuario_id">Usuario</label>
                            <select name="usuario_id" id="usuario_id" class="form-control">
                                <option value="">-- Seleccionar --</option>
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
                                <option value="">-- Seleccionar --</option>
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
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
                            @error('fecha_inicio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha_finalizacion">Fecha de finalización</label>
                            <input type="date" name="fecha_finalizacion" class="form-control" value="{{ old('fecha_finalizacion') }}">
                            @error('fecha_finalizacion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="importe">Importe</label>
                            <input type="text" name="importe" class="form-control" value="{{ old('importe') }}">
                            @error('importe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success shadow">Registrar</button> |
                            <a href="{{ url('/asignaciones') }}" class="btn btn-primary shadow ">Volver al listado</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


