<?php

namespace App\Http\Controllers\Cliente;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\Cliente;
use App\Models\Administrador;

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
    
     public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        $persona = Auth::user();
        return view('cliente.cuenta.show',compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ci)
    {
        $persona= Persona::find($ci);
        
        return view('cliente.cuenta.edit',compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        

    return redirect()->route('cliente.cuenta.show', $persona);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
