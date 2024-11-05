<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $colores = Color::all();
        return view('admin.categoria.color.index',compact('colores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:color,nombre',
            
        ],[
            'nombre.required' => 'El Nombre es obligatorio',
            'nombre.unique' => 'Ese color ya existe'
        ]);

        Color::create([
            'nombre' => $request->nombre,
            'codigo_color' => $request->codigo_color,
        ]);

        return redirect()->back()->with('success', 'Color creado exitosamente.');
    
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'nombre' => "required|string|unique:color,nombre,{$color->cod},cod"
        ],[
            'nombre.unique'=>'Ese color ya existe'
        ]);

        // Actualizar la talla
        $color->update([
            'nombre' => $request->nombre,
            'codigo_color' => $request->codigo_color
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Color actualizada exitosamente.');
   
    }

    public function destroy(Color $color)
    {
        $color->delete(); // Elimina la talla
        return redirect()->back()->with('success', 'Color eliminada correctamente.');
   
    }
}
