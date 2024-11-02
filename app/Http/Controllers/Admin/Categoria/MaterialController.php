<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $materiales = Material::all();
        return view('admin.categoria.material.index',compact('materiales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:material,nombre',
            
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'Ese Material ya existe'
        ]);

        // Crear una nueva talla
        Material::create([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'material creada exitosamente.');
    
    }


    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nombre' => "required|string|unique:material,nombre,{$material->cod},cod"
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'Ese Material ya existe'
        ]);

        // Actualizar la talla
        $material->update([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Material actualizada exitosamente.');
   
    }

    public function destroy(Material $material)
    {
        $material->delete(); // Elimina la talla
        return redirect()->back()->with('success', 'Material eliminada correctamente.');
   
    }
}
