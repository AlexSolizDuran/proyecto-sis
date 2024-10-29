<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = Pais::all();
        return view('admin.categoria.pais.index',compact('paises'));
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
            'cod' => 'required|string|unique:pais,cod',
            'horma' => 'required|string',
            'nombre' => 'required|string'
        ]);

        Pais::create([
            'cod'=> $request->cod,
            'horma' =>$request->horma,
            'nombre' => $request->nombre,
        ]);

        return redirect()->back()->with('succes','Pais creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pais $pais)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pais $pais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pais $pais)
    {
        $request->validate([
            'cod' => "required|string|unique:pais,cod,{$pais->cod},cod",
            'horma' => 'required|string',
            'nombre' => 'required|string',
        ]);
        $pais->update([
            'cod' => $request->cod,
            'horma' => $request->horma,
            'nombre'=>$request->nombre,
        ]);
        return redirect()->back()->with('succes','Pais editado exitomasamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cod)
    {
        $pais = Pais::find($cod);
        $pais->forceDelete();
        
        return redirect()->back()->with('success','Pais eliminado exitosamente');
    }
}
