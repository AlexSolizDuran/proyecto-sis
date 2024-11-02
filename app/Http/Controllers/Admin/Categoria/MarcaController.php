<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $marcas = Marca::all();
        return view('admin.categoria.marca.index',compact('marcas'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:material,nombre', 
        ],[
            'nombre.required' => 'El Nombre es obligatorio',
            'nombre.unique' => 'Esa Marca ya existe'
        ]);

        // Crear una nueva talla
        Marca::create([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'material creada exitosamente.');
    
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => "required|string|unique:marca,nombre,{$marca->cod},cod"
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'Esa Marca ya existe'
        ]);

        // Actualizar la talla
        $marca->update([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Material actualizada exitosamente.');
   
    }

    public function destroy(Marca $marca)
    {
        $marca->delete(); // Elimina la talla
        return redirect()->back()->with('success', 'Material eliminada correctamente.');
   
    }
}
