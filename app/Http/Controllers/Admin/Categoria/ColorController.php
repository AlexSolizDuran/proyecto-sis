<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colores = Color::all();
        return view('admin.categoria.color.index',compact('colores'));
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
            'nombre' => 'required|string|unique:color,nombre',
            
        ]);

        // Crear una nueva talla
        Color::create([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Color creado exitosamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $request->validate([
            'nombre' => 'required|string'
        ]);

        // Actualizar la talla
        $color->update([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Color actualizada exitosamente.');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        $color->delete(); // Elimina la talla
        return redirect()->back()->with('success', 'Color eliminada correctamente.');
   
    }
}
