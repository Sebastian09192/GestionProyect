@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        {{ isset($recurso) ? 'Editar Recurso del Proyecto: ' . $proyecto->nombre : 'Agregar Recurso al Proyecto: ' . $proyecto->nombre }}
    </h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($recurso) 
        ? route('recursos.update', ['proyectoId' => $proyecto->id, 'recursoId' => $recurso->id]) 
        : route('recursos.store', ['proyectoId' => $proyecto->id]) }}" 
        method="POST">

        @csrf
        @if(isset($recurso))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" 
                value="{{ old('nombre', $recurso->nombre ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" id="tipo" class="form-control" 
                value="{{ old('tipo', $recurso->tipo ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="ruta" class="form-label">Ruta</label>
            <input type="text" name="ruta" id="ruta" class="form-control" 
                value="{{ old('ruta', $recurso->ruta ?? '') }}">
        </div>

        <button type="submit" class="btn btn-success">
            {{ isset($recurso) ? 'Actualizar Recurso' : 'Agregar Recurso' }}
        </button>
        <a href="{{ route('recursos.index', ['proyectoId' => $proyecto->id]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection