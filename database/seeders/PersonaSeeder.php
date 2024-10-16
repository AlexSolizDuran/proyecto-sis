<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $persona = Persona::create([
            'ci' => 123456, // Cambia esto por el CI que desees
            'nombre' => 'Cristian', // Nombre del administrador
            'apellido' => 'Torrez', // Apellido del administrador
            'email' => 'prueba@gmail.com', // Correo electrónico
            'direccion' => '2do anillo', // Dirección
            'password' => Hash::make('12345678'), // Contraseña encriptada
            'cel' => 123456789, // Celular
            'tipo' => 'A', // Tipo de usuario, si aplica
        ])->assignRole('admin');
        // Crear un nuevo registro en la tabla administrador
        Administrador::create([
            'cod' => 'AD-1', // Cambia esto por el código que desees
            'ci_persona' => $persona->ci, // Relaciona con la persona creada
        ]);
    }
}
