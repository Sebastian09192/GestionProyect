<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;
use App\Models\Proyecto;

class RecursoController extends Controller
{
    // Mostrar todos los recursos de un proyecto
    public function index($proyectoId) {
        $proyecto = Proyecto::findOrFail($proyectoId);
        $recursos = $proyecto->recursos;
        return view('recursos.index', compact('proyecto', 'recursos'));
    }

    // Mostrar el formulario para crear un recurso
    public function create($proyectoId) {
        $proyecto = Proyecto::findOrFail($proyectoId);
        return view('recursos.form', compact('proyecto'));
    }

    // Mostrar el formulario para editar un recurso
    public function edit($proyectoId, $recursoId) {
        $proyecto = Proyecto::findOrFail($proyectoId);
        $recurso = Recurso::findOrFail($recursoId);
        return view('recursos.form', compact('proyecto', 'recurso'));
    }

    // Guardar un nuevo recurso
    public function store(Request $request, $proyectoId) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo'   => 'required|string|max:50',
            'ruta'   => 'nullable|string',
        ]);

        Recurso::create([
            'nombre'      => $request->nombre,
            'tipo'        => $request->tipo,
            'ruta'        => $request->ruta,
            'proyecto_id' => $proyectoId,
        ]);

        return redirect()->route('recursos.index', ['proyectoId' => $proyectoId])
                         ->with('success', 'Recurso agregado correctamente.');
    }

    // Actualizar un recurso existente
    public function update(Request $request, $proyectoId, $recursoId) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo'   => 'required|string|max:50',
            'ruta'   => 'nullable|string',
        ]);

        $recurso = Recurso::findOrFail($recursoId);
        $recurso->update([
            'nombre' => $request->nombre,
            'tipo'   => $request->tipo,
            'ruta'   => $request->ruta,
        ]);

        return redirect()->route('recursos.index', ['proyectoId' => $proyectoId])
                         ->with('success', 'Recurso actualizado correctamente.');
    }

    // Eliminar un recurso
    public function destroy($proyectoId, $recursoId) {
        $recurso = Recurso::findOrFail($recursoId);
        $recurso->delete();

        return redirect()->route('recursos.index', ['proyectoId' => $proyectoId])
                         ->with('success', 'Recurso eliminado correctamente.');
    }
}