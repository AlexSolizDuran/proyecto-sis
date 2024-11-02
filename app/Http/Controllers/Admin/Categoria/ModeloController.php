<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use App\Models\Marca;

use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:modelo,nombre',
            'cod_marca' => 'required'
        ],[
            'nombre.required'=>'El Nombre es obligatorio',
            'nombre.unique' => 'Ese Modelo ya existe'
        ]);

        // Crear una nueva talla
        Modelo::create([
            'nombre' => $request->nombre,
            'cod_marca' => $request->marca_cod,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Modelo creada exitosamente.');
    }

    public function update(Request $request, Modelo $modelo)
    {
        $request->validate([
            'nombre' => "required|string|unique:modelo,nombre,{$modelo->cod},cod",
            'cod_marca' => 'required'
        ],[
            'nombre.required'=>'El Nombre es obligatorio',
            'nombre.unique' => 'Ese Modelo ya existe'
        ]);

        // Actualizar la talla
        $modelo->update([
            'nombre' => $request->nombre,
            'cod_marca' => $request->marca_cod, 
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Modelo actualizado exitosamente.');
   

    }

    public function destroy(Modelo $modelo)
    {
        //
    }
}
