<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Usuario;

class TareaController extends Controller
{
    // Mostrar todas las tareas de un proyecto
    public function index($proyectoId)
    {
        $proyecto = Proyecto::findOrFail($proyectoId);
        $tareas = $proyecto->tareas()->with('usuario')->get();

        return view('tareas.index', compact('tareas', 'proyecto'));
    }

    // Mostrar el formulario para crear una tarea
    public function create($proyectoId)
    {
        $proyecto = Proyecto::findOrFail($proyectoId);
        $usuarios = Usuario::all();

        return view('tareas.create', compact('proyecto', 'usuarios'));
    }

    // Guardar la nueva tarea
    public function store(Request $request, $proyectoId)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
            'usuario_id' => 'nullable|exists:usuarios,id',
        ]);

        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'proyecto_id' => $proyectoId,
            'usuario_id' => $request->usuario_id,
        ]);

        return redirect()->route('tareas.index', ['proyectoId' => $proyectoId])
                         ->with('success', 'Tarea creada correctamente.');
    }

    // Mostrar el formulario para editar una tarea
    public function edit($proyectoId, $tareaId)
    {
        $proyecto = Proyecto::findOrFail($proyectoId);
        $tarea = Tarea::findOrFail($tareaId);
        $usuarios = Usuario::all();

        return view('tareas.edit', compact('proyecto', 'tarea', 'usuarios'));
    }

    // Actualizar la tarea
    public function update(Request $request, $proyectoId, $tareaId)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
            'usuario_id' => 'nullable|exists:usuarios,id',
        ]);

        $tarea = Tarea::findOrFail($tareaId);
        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'usuario_id' => $request->usuario_id,
        ]);

        return redirect()->route('tareas.index', ['proyectoId' => $proyectoId])
                         ->with('success', 'Tarea actualizada correctamente.');
    }

    // Eliminar una tarea
    public function destroy($proyectoId, $tareaId)
    {
        $tarea = Tarea::findOrFail($tareaId);
        $tarea->delete();

        return redirect()->route('tareas.index', ['proyectoId' => $proyectoId])
                         ->with('success', 'Tarea eliminada correctamente.');
    }
}
