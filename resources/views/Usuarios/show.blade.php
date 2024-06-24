@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Datos del Usuario</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
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
                    <label for="name">Nombre</label>
                    <p>{{ $usuario->name }}</p>

                    <label for="email">Email</label>
                    <p>{{ $usuario->email }}</p>

                    <label for="role">Rol</label>
                    <p>{{ $usuario->role }}</p>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ url('/usuarios') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
