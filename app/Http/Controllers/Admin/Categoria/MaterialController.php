<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiales = Material::all();
        return view('admin.categoria.material.index',compact('materiales'));
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
            'nombre' => 'required|string|unique:material,nombre',
            
        ]);

        // Crear una nueva talla
        Material::create([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'material creada exitosamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nombre' => 'required|string'
        ]);

        // Actualizar la talla
        $material->update([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Material actualizada exitosamente.');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete(); // Elimina la talla
        return redirect()->back()->with('success', 'Material eliminada correctamente.');
   
    }
}
