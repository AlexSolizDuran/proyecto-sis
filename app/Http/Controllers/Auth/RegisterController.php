<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\Cliente;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'ci' => ['required','integer'],
            'nombre' => ['required', 'string'],
            'apellido' => ['required', 'string'],
            'cel' => ['required','integer'],
            'direccion' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:persona'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $Persona = Persona::create([
            'ci' => $data['ci'],
            'nombre' => $data['nombre'],
            'apellido'=> $data['apellido'],
            'cel'=> $data['cel'],
            'direccion'=> $data['direccion'],
            'tipo' => 'C',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->assignRole('cliente');

        $ci = Cliente::create([
            'ci_persona' => $data['ci'],
        ]);
        Bitacora::create([
            'ci' => $ci->ci_persona,
            'ip' => request()->ip(),
            'accion' => 'Se Registro al sistema', // Cambia esto según la acción
            'fecha' => now()->format('Y-m-d'), // Fecha actual
            'hora' => now()->format('H:i:s'), // Hora actual
        ]);
        
        return $Persona; 
    }
}
