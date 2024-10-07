<?php

namespace App\Http\Controllers;

use App\Models\LoteMercaderia;
use App\Models\Marca;
use Illuminate\Http\Request;

class LoteMercaderiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::all(); // Obtener todas las marcas para el formulario
        return view('admin.lote_mercaderia.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cod' => 'required|integer|unique:lote_mercaderia,cod',
            'cantidad_total_pares' => 'required|integer',
            'impuestos' => 'required|numeric',
            'precio_compra' => 'required|numeric',
            'fecha_compra' => 'required|date',
            'precio_logistica' => 'required|numeric',
            'cod_marca' => 'required|exists:marca,cod', // Validar que la marca exista
        ]);

        // Crear el lote de mercadería
        LoteMercaderia::create($request->all());

        return redirect()->route('admin.lote_mercaderia.index')->with('success', 'Lote de mercadería creado con éxito.');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
