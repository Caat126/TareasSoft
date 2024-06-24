@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Datos del Curso</h1>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <label for="nombre">Nombre:</label>
                        <p>{{ $curso->name }}</p>

                        <label for="descripcion">Descripción:</label>
                        <p>{!! $curso->description !!}</p>

                        <label for="imagen">Imagen:</label>
                        <p><img src="{{ $curso->getImagenUrl() }}" class="img-fluid" alt=""></p>

                        <label for="precio">Precio:</label>
                        <p>{{ $curso->price }} Bs</p>

                        <label for="estado">Estado:</label>
                        <p>
                            @if ($curso->status == true)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">Inactivo</span>
                            @endif
                        </p>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ url('/cursos') }}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
