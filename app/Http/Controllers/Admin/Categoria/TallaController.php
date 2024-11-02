<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tallas = Talla::all();
        return view('admin.categoria.talla.index',compact('tallas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|numeric|unique:talla,numero',
        ],[
            'numero.required' => 'El Numero es obligario',
            'numero.unique' => 'Ya existe ese numero de Talla'
        ]);

        // Crear una nueva talla
        Talla::create([
            'numero' => $request->numero,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Talla creada exitosamente.');
    
    }

    public function update(Request $request, Talla $talla)
    {
        $request->validate([
            'numero' => "required|numeric|unique:talla,numero,{$talla->cod},cod"
        ],[
            'numero.required' => 'El Numero es obligario',
            'numero.unique' => 'Ya existe ese numero de Talla'
        ]);

        // Actualizar la talla
        $talla->update([
            'numero' => $request->numero,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Talla actualizada exitosamente.');
   
    }

    public function destroy(Talla $talla)
    {
        $talla->delete(); // Elimina la talla
        return redirect()->back()->with('success', 'Talla eliminada correctamente.');
   
    }
}
