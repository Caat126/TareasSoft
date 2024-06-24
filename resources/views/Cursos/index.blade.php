@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cursos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item active">Cursos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        @if (auth()->user()->role == 'Admin')
        <div class="text-end">
            <a href="{{ route('cursos.create') }}" class="btn btn-success mb-3">Nuevo Curso</a>
        </div>
        @endif

        @include('includes.alertas')

        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }} Bs</td>
                        <td>
                            @if ($item->status == true)
                            <span class="badge badge-success">Activo</span>
                            @else
                            <span class="badge badge-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('cursos.show', $item->id) }}" class="btn btn-dark"><i class="fas fa-eye"></i></a>
                            @if (auth()->user()->role == 'Admin')
                                <a href="{{ route('cursos.edit', $item->id) }}" class="btn btn-primary ">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if ($item->status == true)
                                    <a href="{{ url('/curso/estado/' . $item->id) }}" class="btn btn-danger ">
                                    <i class="fa fa-ban"></i>
                                    </a>
                                @else
                                    <a href="{{ url('/curso/estado/' . $item->id) }}" class="btn btn-success">
                                    <i class="fa fa-check"></i>
                                    </a>
                                    <form action="{{ route('cursos.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este curso?')">
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
            {{ $cursos->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@endsection
