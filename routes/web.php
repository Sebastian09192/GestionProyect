<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\UsuarioController;

// Ruta de inicio
Route::get('/', [ProyectoController::class, 'index'])->name('proyectos.index');

// Rutas de Proyectos (CRUD)
Route::resource('proyectos', ProyectoController::class);

// Rutas de Tareas
Route::prefix('proyectos/{proyectoId}')->group(function () {
    Route::get('tareas', [TareaController::class, 'index'])->name('tareas.index');
    Route::get('tareas/create', [TareaController::class, 'create'])->name('tareas.create');
    Route::post('tareas', [TareaController::class, 'store'])->name('tareas.store');
    Route::delete('tareas/{tareaId}', [TareaController::class, 'destroy'])->name('tareas.destroy');
    Route::get('tareas/{tareaId}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
    Route::put('tareas/{tareaId}', [TareaController::class, 'update'])->name('tareas.update');
});

// Rutas de Recursos
Route::prefix('proyectos/{proyectoId}')->group(function () {
    Route::get('recursos', [RecursoController::class, 'index'])->name('recursos.index');
    Route::get('recursos/create', [RecursoController::class, 'create'])->name('recursos.create');
    Route::post('recursos', [RecursoController::class, 'store'])->name('recursos.store');
    Route::get('recursos/{recursoId}/edit', [RecursoController::class, 'edit'])->name('recursos.edit');
    Route::put('recursos/{recursoId}', [RecursoController::class, 'update'])->name('recursos.update');
    Route::delete('recursos/{recursoId}', [RecursoController::class, 'destroy'])->name('recursos.destroy');
});

Route::resource('usuarios', UsuarioController::class);