@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tareas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item active">Tareas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="text-end">
            <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>
        </div>

        @include('includes.alertas')

        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Asignacion</th>
                        <th>Descripción</th>
                        <th>Entrega</th>
                        <th>Nota</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tareas as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->asignacion->nombre }}</td>
                            <td>{!! $item->descripcion !!}</td>
                            <td>{{\Carbon\Carbon::parse($item->entrega)->format('Y-m-d')}}</td>
                            <td>{{ $item->nota }}</td>
                            <td>
                                <a href="{{ route('tareas.edit', $item->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tareas.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
