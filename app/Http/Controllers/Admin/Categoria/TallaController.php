<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tallas = Talla::all();
        return view('admin.categoria.talla.index',compact('tallas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|numeric|unique:talla,numero',
            
        ]);

        // Crear una nueva talla
        Talla::create([
            'numero' => $request->numero,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Talla creada exitosamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Talla $talla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talla $talla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Talla $talla)
    {
        $request->validate([
            'numero' => 'required|numeric'
        ]);

        // Actualizar la talla
        $talla->update([
            'numero' => $request->numero,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Talla actualizada exitosamente.');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talla $talla)
    {
        $talla->delete(); // Elimina la talla
        return redirect()->back()->with('success', 'Talla eliminada correctamente.');
   
    }
}
