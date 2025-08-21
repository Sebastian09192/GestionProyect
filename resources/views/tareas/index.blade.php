@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tareas del Proyecto: {{ $proyecto->nombre ?? 'General' }}</h2>

    <a href="{{ route('tareas.create', ['proyectoId' => $proyecto->id]) }}" class="btn btn-success mb-3">Agregar Tarea</a>

    @if($tareas->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Usuario Asignado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>
                        <span class="badge 
                            {{ $tarea->estado == 'pendiente' ? 'bg-warning text-dark' : '' }}
                            {{ $tarea->estado == 'en_progreso' ? 'bg-info text-dark' : '' }}
                            {{ $tarea->estado == 'completada' ? 'bg-success' : '' }}
                        ">
                            {{ $tarea->estado }}
                        </span>
                    </td>
                    <td>{{ $tarea->usuario->nombre ?? 'Sin asignar' }}</td>
                    <td>
                        <a href="{{ route('tareas.edit', ['proyectoId' => $proyecto->id, 'tareaId' => $tarea->id]) }}" class="btn btn-sm btn-primary mb-1">Editar</a>
                        <form action="{{ route('tareas.destroy', ['proyectoId' => $proyecto->id, 'tareaId' => $tarea->id]) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar esta tarea?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No hay tareas registradas.</p>
    @endif
</div>
@endsection