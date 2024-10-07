<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::with(['persona'])->get();
        return view ('admin.cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'ci' => 'required|integer|unique:persona',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'cel' => 'required|integer',
            'direccion' => 'required|string',
            'gmail' => 'required|string',
        ]);

        Persona::create([
            'ci' => $validacion['ci'],
            'nombre' => $validacion['nombre'],
            'apellido' => $validacion['apellido'],
            'cel' => $validacion['cel'],
            'tipo' => 'c'
        ]);
        Cliente::create([
            'ci_persona' => $validacion['ci'],
            'direccion' => $validacion['direccion'],
            'gmail' => $validacion['gmail'],
        ]);

        return redirect()-> route('admin.cliente.index')->with('success','cliente creado exitosamentes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $cliente->load('persona');

        return view ('admin.cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $cliente->load('persona');
        return view('admin.cliente.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validacion = $request->validate([
            'ci_persona' => "required|integer|unique:cliente,ci_persona,{$cliente->ci_persona},ci_persona",
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'cel' => 'required|integer',
            'direccion' => 'required|string',
            'gmail' => 'required|string',
        ]);

        $cliente->persona->ci = $validacion['ci_persona'];
        $cliente->persona->nombre = $validacion['nombre'];
        $cliente->persona->apellido = $validacion['apellido'];
        $cliente->persona->cel = $validacion['cel'];

        $cliente->persona->update();

        $cliente->ci_persona = $validacion['ci_persona'];
        $cliente->direccion = $validacion['direccion'];
        $cliente->gmail = $validacion['gmail'];
    
        $cliente->update();

    
        return redirect()->route('admin.cliente.index')->with('success', 'Cliente actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        
        $cliente->delete();
        $cliente->persona->delete();
        return redirect()->route('admin.cliente.index')->with('success','cliente a sido eliminado exitosamente');
    }
}
