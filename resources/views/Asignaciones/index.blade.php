@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Asignaciones</h1>
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
        <div class="text-end">
            @if (auth()->user()->role == 'Admin')
            <a href="{{ route('asignaciones.create') }}" class="btn btn-success mb-3">Nueva Asignación</a>
            @else
            <a href="{{ route('asignaciones.create') }}" class="btn btn-success mb-3">Asignarme a curso</a>
            @endif
        </div>

        @include('includes.alertas')

        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Curso</th>
                        <th>Nombre</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalización</th>
                        <th>Importe</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asigs as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->usuario->name }}</td>
                            <td>{{ $item->curso->name }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{\Carbon\Carbon::parse($item->fecha_inicio)->format('Y-m-d')}}</td>
                            <td>{{\Carbon\Carbon::parse($item->fecha_fin)->format('Y-m-d')}}</td>
                            <td>{{ $item->importe }} Bs</td>
                            <td>
                                @if ($item->estado == true)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('asignaciones.show', $item->id) }}" class="btn btn-dark">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if (auth()->user()->role == 'Admin')
                                    <a href="{{ route('asignaciones.edit', $item->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if ($item->estado == true)
                                        <a href="{{ url('/asignacion/estado/' . $item->id) }}" class="btn btn-danger">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                    @else
                                        <a href="{{ url('/asignacion/estado/' . $item->id) }}" class="btn btn-success">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <form action="{{ route('asignaciones.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
