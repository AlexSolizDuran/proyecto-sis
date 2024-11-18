<?php

namespace App\Http\Controllers\Admin\Compra;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $paises = Pais::all();
        return view('admin.categoria.pais.index',compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cod' => 'required|string|unique:pais,cod',
            'horma' => 'required|string',
            'nombre' => 'required|string|unique:pais,nombre'
        ],[
            'cod.required' => 'El Codigo es Obligatorio',
            'cod.unique'=> 'Ya existe un pais con ese codigo',
            'nombre.required' => 'El nombre es Obligatorio',
            'nombre.unique' => 'Ya existe un pais con ese nombre'
        ]);

        Pais::create([
            'cod'=> $request->cod,
            'horma' =>$request->horma,
            'nombre' => $request->nombre,
        ]);

        return redirect()->back()->with('succes','Pais creado con exito');
    }
    public function update(Request $request, Pais $pais)
    {
        $request->validate([
            'cod' => "required|string|unique:pais,cod,{$pais->cod},cod",
            'horma' => 'required|string',
            'nombre' => "required|string|unique:pais,nombre,{$pais->cod},cod",
        ],[
            'cod.required' => 'El Codigo es Obligatorio',
            'cod.unique'=> 'Ya existe un pais con ese codigo',
            'nombre.required' => 'El nombre es Obligatorio',
            'nombre.unique' => 'Ya existe un pais con ese nombre'
        ]);
        $pais->update([
            'cod' => $request->cod,
            'horma' => $request->horma,
            'nombre'=>$request->nombre,
        ]);
        return redirect()->back()->with('succes','Pais editado exitomasamente');
    }

    public function destroy($cod)
    {
        $pais = Pais::find($cod);
        $pais->forceDelete();
        
        return redirect()->back()->with('success','Pais eliminado exitosamente');
    }
}
