<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="mb-4 text-center">Gestión de Proyectos</h1>

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

    {{-- Mostrar mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario de creación de proyecto --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">Nuevo Proyecto</div>
        <div class="card-body">
            <form action="{{ route('proyectos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Proyecto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Asignar Usuario Líder</label>
                    <select name="usuario_id" id="usuario_id" class="form-control" required>
                        <option value="">-- Selecciona un usuario --</option>
                        @foreach(App\Models\Usuario::all() as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar Proyecto</button>
            </form>
        </div>
    </div>

    {{-- 🔹 Botón para ir al CRUD de usuarios --}}
    <div class="mb-4">
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">👤 Gestionar Usuarios</a>
    </div>

    {{-- Listado de proyectos --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Lista de Proyectos</div>
        <div class="card-body">
            @if($proyectos->count() > 0)
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyectos as $proyecto)
                            <tr>
                                <td>{{ $proyecto->id }}</td>
                                <td>{{ $proyecto->nombre }}</td>
                                <td>{{ $proyecto->descripcion }}</td>
                                <td>{{ $proyecto->fecha_inicio }}</td>
                                <td>{{ $proyecto->fecha_fin }}</td>
                                <td>
                                    {{-- Rutas corregidas: los parámetros deben coincidir con la ruta --}}
                                    <a href="{{ route('tareas.index', ['proyectoId' => $proyecto->id]) }}" class="btn btn-sm btn-info mb-1">Tareas</a>
                                    <a href="{{ route('recursos.index', ['proyectoId' => $proyecto->id]) }}" class="btn btn-sm btn-warning mb-1">Recursos</a>

                                    <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este proyecto?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No hay proyectos registrados.</p>
            @endif
        </div>
    </div>
</div>
</body>
</html>