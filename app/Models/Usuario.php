<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; 

    protected $fillable = ['nombre', 'email', 'password'];

    protected $hidden = ['password'];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}