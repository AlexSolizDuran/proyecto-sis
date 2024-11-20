<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Cliente;
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

        $persona = Persona::create([
            'ci' => 9009660, // Cambia esto por el CI que desees
            'nombre' => 'Alex', // Nombre del administrador
            'apellido' => 'Soliz', // Apellido del administrador
            'email' => 'prueba1@gmail.com', // Correo electrónico
            'direccion' => 'Plan 3000', // Dirección
            'password' => Hash::make('9009660'), // Contraseña encriptada
            'cel' => 71304025, // Celular
            'tipo' => 'C', // Tipo de usuario, si aplica
        ])->assignRole('cliente');
        // Crear un nuevo registro en la tabla administrador
        Cliente::create([
            'ci_persona' => $persona->ci, // Relaciona con la persona creada
        ]);

        $persona = Persona::create([
            'ci' => 10236456,
            'nombre' => 'Elena',
            'apellido' => 'Ramos',
            'email' => 'elena.ramos@gmail.com',
            'direccion' => 'Calle 10, ub. alianza',
            'password' => Hash::make('10236456'),
            'cel' => 79501237,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        
        $persona = Persona::create([
            'ci' => 12345678,
            'nombre' => 'pedro',
            'apellido' => 'muñoz',
            'email' => 'pedro.muñoz@gmail.com',
            'direccion' => 'av brazil',
            'password' => Hash::make('12345678'),
            'cel' => 63367351,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);

        $persona = Persona::create([
            'ci' => 12345685,
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'juan.perez@gmail.com',
            'direccion' => 'Calle 1, villa 1ro de mayo',
            'password' => Hash::make('12345685'),
            'cel' => 75512347,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);

        $persona = Persona::create([
            'ci' => 23456744,
            'nombre' => 'Maria',
            'apellido' => 'Lopez',
            'email' => 'maria.lopez@gmail.com',
            'direccion' => 'Calle 2, melchor',
            'password' => Hash::make('23456744'),
            'cel' => 71523458,
            'tipo' => 'C',
        ])->assignRole('cliente');

        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);

        $persona = Persona::create([
            'ci' => 24876543,
            'nombre' => 'manuel',
            'apellido' => 'sambrana',
            'email' => 'manuel.sambrana@gmail.com',
            'direccion' => 'km 6 doble via a la guardia',
            'password' => Hash::make('24876543'),
            'cel' => 78985414,
            'tipo' => 'C',
        ])->assignRole('cliente');

        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);

        $persona = Persona::create([
            'ci' => 34567833,
            'nombre' => 'Carlos',
            'apellido' => 'Garcia',
            'email' => 'carlos.garcia@gmail.com',
            'direccion' => 'Calle 3, las vegas',
            'password' => Hash::make('34567833'),
            'cel' => 72534569,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
  
        $persona = Persona::create([
            'ci' => 34567890,
            'nombre' => 'jhonny',
            'apellido' => 'sanchez',
            'email' => 'yonSanchez1@gmail.com',
            'direccion' => 'los pozos',
            'password' => Hash::make('34567890'),
            'cel' => 70055946,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        $persona = Persona::create([     					
            'ci' => 45678495,
            'nombre' => 'Ana',
            'apellido' => 'Martinez',
            'email' => 'ana.martinez@gmail.com',
            'direccion' => 'Calle 4, km6 doble via a la guardia',
            'password' => Hash::make('45678495'),
            'cel' => 73545671,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        					
        $persona = Persona::create([
            'ci' => 50219876,
            'nombre' => 'eduardo',
            'apellido' => 'chumacero',
            'email' =>'ingEduardo7@gmail.com',
            'direccion' => '7mo anillo',
            'password' => Hash::make('50219876'),
            'cel' => 68457812,
            'tipo' =>'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        					
        $persona = Persona::create([
            'ci' => 56789012,
            'nombre' => 'wiily',
            'apellido' => 'rodriguez',
            'email' => 'billiRo70055946@gmail.com',
            'direccion' => 'km 13 doble via a la guardia',
            'password' => Hash::make('56789012'),
            'cel' => 71452112,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        					
        $persona = Persona::create([
            'ci' => 56789054,
            'nombre' => 'Luis',
            'apellido' => 'Rodriguez',
            'email' => 'luis.rodriguez@gmail.com',
            'direccion' => 'Calle 5, av. busch',
            'password' => Hash::make('56789054'),
            'cel' => 74556782,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);

        $persona = Persona::create([
            'ci' => 60987654,
            'nombre' => 'orlando',
            'apellido' => 'terrazas',
            'email' => 'orlandocarpintero@gmail.com',
            'direccion' => 'av busch',
            'password' => Hash::make('60987654'),
            'cel' => 76713598,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);

        $persona = Persona::create([
            'ci' => 67859015,
            'nombre' => 'Sofia',
            'apellido' => 'Gomez',
            'email' => 'sofia.gomez',
            'direccion' => 'Calle 6, radial 17/2',
            'password' => Hash::make('67859015'),
            'cel' => 75567893,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        					
        $persona = Persona::create([
            'ci' => 78940129,
            'nombre' => 'Miguel',
            'apellido' => 'Hernandez',
            'email' => 'miguel.hernandez@gmail.com',
            'direccion' => 'Calle 7, av. honduras',
            'password' => Hash::make('78940129'),
            'cel' => 76578904,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        					
        $persona = Persona::create([
            'ci' => 83123456,
            'nombre' => 'david',
            'apellido' => 'colque',
            'email' => 'davidcolque7589@gmail.com',
            'direccion' => '3er anillo externo',
            'password' => Hash::make('83123456'),
            'cel' =>75899874,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        					
        $persona = Persona::create([
            'ci' => 89201231,
            'nombre' => 'Lucia',
            'apellido' => 'Torres',
            'email' => 'lucia.torres@gmail.com',
            'direccion' => 'Calle 8, plaza 24 sep',
            'password' => Hash::make('89201231'),
            'cel' => 77589015,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        					
        $persona = Persona::create([
            'ci' => 90122343,
            'nombre' => 'Jorge',
            'apellido' => 'Diaz',
            'email' => 'jorge.diaz@gmail.com',
            'direccion' =>'Calle 9, av. paraiso',
            'password' => Hash::make('90122343'),
            'cel' => 78590126,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        					
        $persona = Persona::create([
            'ci' => 97794614,
            'nombre' => 'javier',
            'apellido' => 'milei',
            'email' => 'javiermilei777@gmail.com',
            'direccion' => 'calle buenos aires',
            'password' => Hash::make('97794614'),
            'cel' => 77951265,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
        				
        $persona = Persona::create([
            'ci' => 98765432,
            'nombre' => 'juan',
            'apellido' => 'medrano',
            'email' => 'tujuancitoM@gmail.com',
            'direccion' => '3er anillo interno',
            'password' => Hash::make('98765432'),
            'cel' => 72225356,
            'tipo' => 'C',
        ])->assignRole('cliente');
        Cliente::create([
            'ci_persona' => $persona->ci,
        ]);
    }
}
