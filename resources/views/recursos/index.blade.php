@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Recursos del Proyecto: {{ $proyecto->nombre ?? 'General' }}</h2>

    <a href="{{ route('recursos.create', ['proyectoId' => $proyecto->id]) }}" class="btn btn-success mb-3">Agregar Recurso</a>

    @if($recursos->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Ruta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recursos as $recurso)
                <tr>
                    <td>{{ $recurso->id }}</td>
                    <td>{{ $recurso->nombre }}</td>
                    <td>{{ $recurso->tipo }}</td>
                    <td>{{ $recurso->ruta ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('recursos.edit', ['proyectoId' => $proyecto->id, 'recursoId' => $recurso->id]) }}" class="btn btn-sm btn-primary mb-1">Editar</a>

                        <form action="{{ route('recursos.destroy', ['proyectoId' => $proyecto->id, 'recursoId' => $recurso->id]) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este recurso?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No hay recursos para este proyecto.</p>
    @endif
</div>
@endsection