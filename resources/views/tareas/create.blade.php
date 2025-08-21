@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Agregar Tarea al Proyecto: {{ $proyecto->nombre }}</h2>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tareas.store', ['proyectoId' => $proyecto->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título de la Tarea</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="pendiente">Pendiente</option>
                <option value="en_progreso">En Progreso</option>
                <option value="completada">Completada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Asignar Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-control">
                <option value="">-- Selecciona un usuario --</option>
                @foreach(App\Models\Usuario::all() as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Agregar Tarea</button>
        <a href="{{ route('tareas.index', ['proyectoId' => $proyecto->id]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection