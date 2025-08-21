<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .navbar-custom {
            background-color: #32cd32; /* verde lima */
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #fff;
        }
        .table thead {
            background-color: #32cd32;
            color: #fff;
        }
        .btn-success {
            background-color: #32cd32;
            border-color: #28a428;
        }
        .btn-success:hover {
            background-color: #28a428;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">GestorProyectos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- Si hay proyecto cargado, mostrar sus secciones --}}
                    @isset($proyecto)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tareas.index', ['proyectoId' => $proyecto->id]) }}">Tareas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('recursos.index', ['proyectoId' => $proyecto->id]) }}">Recursos</a>
                        </li>
                    @else
                        {{-- Si no hay proyecto específico, mostrar accesos generales --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('proyectos.index') }}">Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                        </li>
                    @endisset
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="container">
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Mostrar mensajes de éxito --}}
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif

        {{-- Contenido específico de cada vista --}}
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>