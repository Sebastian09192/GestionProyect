<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Usuario;

class ProyectoController extends Controller
{
    // Listar todos los proyectos y mostrarlos en la vista principal (welcome.blade.php)
    public function index()
    {
        $proyectos = Proyecto::all();
        $usuarios = Usuario::all(); // Para el formulario de asignar líder
        return view('welcome', compact('proyectos','usuarios'));
    }

    // Guardar un proyecto nuevo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente.');
    }

    // Mostrar un proyecto específico (opcional si no se usa)
    public function show(Proyecto $proyecto)
    {
        //
    }

    // Editar proyecto (puedes implementar modal en welcome si quieres)
    public function edit(Proyecto $proyecto)
    {
        $usuarios = Usuario::all();
        return view('welcome', compact('proyecto','usuarios'));
    }

    // Actualizar proyecto
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    // Eliminar proyecto
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado.');
    }
}