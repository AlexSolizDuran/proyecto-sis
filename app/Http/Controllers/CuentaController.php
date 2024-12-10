<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\NotaVenta;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showChangePasswordForm()
    {
        return view('auth.passwords.reset'); // Asegúrate de crear esta vista
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'nueva_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Obtener el usuario autenticado
        $persona = Persona::where('ci', Auth::user()->ci)->first();

        if (!$persona) {
            return back()->withErrors(['error' => 'Usuario no encontrado.']);
        }

        // Verificar la contraseña actual
        if (!Hash::check($request->nueva_password, $persona->password)) {
            return back()->withErrors(['nueva_password' => 'La contraseña actual es incorrecta.']);
        }

        // Cambiar la contraseña
        $persona->password = Hash::make($request->password);
        $persona->save();

        if ($persona->tipo === 'C') {
            Bitacora::create([
                'ci' => $persona->ci,
                'ip' => request()->ip(),
                'accion' => 'Cambio contraseña',
                'fecha' => now()->format('Y-m-d'),
                'hora' => now()->format('H:i:s'),
            ]);
        }

        return redirect()->route('cliente.cuenta.show', $persona->ci)->with('success', 'Contraseña cambiada exitosamente.');
    }

    public function show(Persona $persona)
    {
        $persona = Auth::user();
        return view('cliente.cuenta.show',compact('persona'));
    }
    public function detalle(string $id)
    {
        $venta = NotaVenta::findOrFail($id);
        //$venta = NotaVenta::where('ci_cliente', $cliente)->first();
        return view('cliente.cuenta.detalle',compact('venta'));
    }
  
    public function edit($ci)
    {
        $persona= Persona::find($ci);
        
        return view('cliente.cuenta.edit',compact('persona'));
    }

   
    public function update(Request $request, $ci)
    {
        
        $validacion = $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'cel' => 'required|integer',
            'direccion' => 'required|string',
        ]);
        $persona = Persona::find($ci);
        $persona->nombre = $validacion['nombre'];
        $persona->apellido = $validacion['apellido'];
        $persona->cel = $validacion['cel'];
        $persona->direccion = $validacion['direccion'];
        $persona->update();

        if ((Auth::user()->tipo) == 'C'){
            Bitacora::create([
                'ci' => Auth::user()->ci,
                'ip' => request()->ip(),
                'accion' => 'Actulizo sus Datos', // Cambia esto según la acción
                'fecha' => now()->format('Y-m-d'), // Fecha actual
                'hora' => now()->format('H:i:s'), // Hora actual
            ]);
        };    

    return redirect()->route('cliente.cuenta.show', $persona);

    }

  
}
