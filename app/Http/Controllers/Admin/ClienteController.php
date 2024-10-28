<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class ClienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
     public function index()
    {
        $clientes = Cliente::with(['persona'])->get();
        return view ('admin.cliente.index', compact('clientes'));
    }

    public function create()
    {
        return view('admin.cliente.create');
    }

    
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'ci' => 'required|integer|unique:persona',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'cel' => 'required|integer',
            'direccion' => 'required|string',
            'email' => 'required|string',
        ]);
        

        Persona::create([
            'ci' => $validacion['ci'],
            'nombre' => $validacion['nombre'],
            'apellido' => $validacion['apellido'],
            'cel' => $validacion['cel'],
            'direccion' => $validacion['direccion'],
            'email' => $validacion['email'],
            'tipo' => 'C',
            'password' => Hash::make($validacion['ci'])
        ])->assignRole('cliente');

        Cliente::create([
            'ci_persona' => $validacion['ci'],
            
        ]);

        return redirect()-> route('admin.cliente.index')->with('success','cliente creado exitosamentes');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('persona');
        return view ('admin.cliente.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $cliente->load('persona');
        return view('admin.cliente.edit',compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validacion = $request->validate([
            'ci_persona' => "required|integer|unique:cliente,ci_persona,{$cliente->ci_persona},ci_persona",
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'cel' => 'required|integer',
            'direccion' => 'required|string',
            'email' => 'required|string',
        ]);
        $cliente->persona->ci = $validacion['ci_persona'];
        $cliente->persona->nombre = $validacion['nombre'];
        $cliente->persona->apellido = $validacion['apellido'];
        $cliente->persona->cel = $validacion['cel'];
        $cliente->persona->direccion = $validacion['direccion'];
        $cliente->persona->email = $validacion['email'];
        $cliente->persona->update();

        $cliente->ci_persona = $validacion['ci_persona'];
        $cliente->update();

        return redirect()->route('admin.cliente.index')->with('success', 'Cliente actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        
        
        $cliente->persona->delete();
        return redirect()->route('admin.cliente.index')->with('success','cliente a sido eliminado exitosamente');
    }
}
