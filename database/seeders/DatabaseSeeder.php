<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Administrador::updateOrCreate(
            ['cod' => 'ad-1'], // Condición para encontrar el registro
            [
                'ci_persona' => 13703159,
                'email' => 'prueba1@example.com', // Valor actualizado
                'password' => Hash::make('12345678'), // Contraseña actualizada
            ]
        );

        Administrador::updateOrCreate(
            ['cod' => 'ad-2'],
            [
                'ci_persona' => 14770954,
                'email' => 'prueba2@example.com',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}
