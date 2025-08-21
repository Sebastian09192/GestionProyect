<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'nombre' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        Usuario::create([
            'nombre' => 'Usuario1',
            'email' => 'usuario1@example.com',
            'password' => Hash::make('123456')
        ]);
    }
}