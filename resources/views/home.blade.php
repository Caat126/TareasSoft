@extends('layouts.app')

@section('content')

@php
$adminCount = \App\Models\User::where('role', 'admin')->count();
$estudianteCount = \App\Models\User::where('role', 'estudiante')->count();
@endphp

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Bienvenido</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    {{-- <li class="breadcrumb-item active">Starter Page</li> --}}
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger shadow">
                    <div class="inner">
                        <p>Admins</p>
                        <h3>{{ $adminCount }}</h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success shadow">
                    <div class="inner">
                        <p>Estudiantes</p>
                        <h3>{{ $estudianteCount }}</h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-graduate"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
