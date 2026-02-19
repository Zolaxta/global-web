<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear el Administrador Principal
        User::create([
            'name' => 'Roberto Lozano Acosta',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
            'points' => 0, 
        ]);

        // 2. Crear un Usuario Normal (Jugador) para pruebas
        User::create([
            'name' => 'Jugador Prueba',
            'email' => 'jugador@test.com',
            'password' => Hash::make('jugador123'),
            'role' => 'player',
            'points' => 500, // 500 puntos iniciales para el canje
        ]);
    }
}
