<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use App\Models\Marca;

use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function obtenerModelos($marcaId)
    {
        $modelos = Modelo::where('cod_marca', $marcaId)->get();
        return response()->json($modelos);
    }
    public function index()
    {
        $modelos = Modelo::all();
        $marcas = Marca::all();
        return view('admin.categoria.modelo.index',compact('modelos','marcas'));
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
        $request->validate([
            'nombre' => 'required|string|unique:modelo,nombre',
            
        ]);

        // Crear una nueva talla
        Modelo::create([
            'nombre' => $request->nombre,
            'cod_marca' => $request->marca_cod,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Modelo creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Modelo $modelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modelo $modelo)
    {
        $request->validate([
            'nombre' => 'required|string'
        ]);

        // Actualizar la talla
        $modelo->update([
            'nombre' => $request->nombre,
            'cod_marca' => $request->marca_cod, 
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Modelo actualizado exitosamente.');
   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelo $modelo)
    {
        //
    }
}
