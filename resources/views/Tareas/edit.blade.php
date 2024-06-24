@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Tarea</h1>
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
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">

                    @include('includes.alertas')

                    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="asig_id">Asignacion</label>
                            <select name="asig_id" id="asig_id" class="form-control">
                                <option value="{{ $tarea->asig_id }}">{{ $tarea->asignacion->nombre }}</option>
                                @foreach ($asigs as $asign)
                                    <option value="{{ $asign->id }}">{{ $asign->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="usuario_id">Estudiante</label>
                            <select name="usuario_id" id="usuario_id" class="form-control">
                                <option value="{{ $tarea->usuario_id }}">{{ $tarea->usuario->name }}</option>
                                @if (auth()->user()->role == 'Admin')
                                    @foreach ($usuarios as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @else
                                    <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" id="contenido" cols="30" rows="10" class="form-control">{{ $tarea->descripcion }}</textarea>
                            @error('descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="entrega">Fecha de Entrega</label>
                                    <input type="date" name="entrega" class="form-control" value="{{ $tarea->entrega }}">
                                    @error('entrega')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nota">Nota</label>
                                    <input type="text" name="nota" class="form-control" value="{{ $tarea->nota }}">
                                    @error('nota')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success shadow">Actualizar</button> | <a href="{{ url('/tareas') }}" class="btn btn-primary shadow">Cancelar</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#contenido').summernote({
                placeholder: 'Escribe la descripcion del curso',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
