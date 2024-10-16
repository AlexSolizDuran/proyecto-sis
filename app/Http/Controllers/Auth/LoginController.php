<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de tener una vista de inicio de sesión
    }

    public function login(Request $request)
    {   
        
        // Validar las credenciales
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Obtener las credenciales
        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->intended($this->redirectTo); // Redirigir a la ruta definida
        }

        // Si no se pudo autenticar
        return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Cambia esto a la ruta que desees después de cerrar sesión
    }

    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Asegúrate de tener una vista de registro
    }

    /**
     * Maneja una solicitud de registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validar los datos del registro
        $request->validate([
            'ci' => 'required|integer|unique:persona,ci',
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
            'gmail' => 'required|string|email|max:255|unique:persona,gmail',
            'direccion' => 'required|string|max:60',
            'cel' => 'required|integer',
            'password' => 'required|string|min:8|confirmed', // confirmación de contraseña
        ]);

        // Crear una nueva instancia de Persona
        $persona = new Persona();
        $persona->ci = $request->ci;
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->gmail = $request->gmail;
        $persona->direccion = $request->direccion;
        $persona->cel = $request->cel;
        $persona->tipo = 'C'; // o 'A', según sea cliente o administrador
        $persona->password = Hash::make($request->password); // Encriptar la contraseña

        // Guardar la nueva persona en la base de datos
        $persona->save();

        // Autenticar al nuevo usuario
        Auth::login($persona);

        // Redirigir a la ruta definida
        return redirect($this->redirectTo);
    }


}
