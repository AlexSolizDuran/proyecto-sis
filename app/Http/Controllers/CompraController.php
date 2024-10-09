<?php

namespace App\Http\Controllers;

use App\Models\LoteMercaderia;
use App\Models\Marca;
use App\Models\Pais;
use App\Models\Calzado;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showForm()
    {
        // Obtener todos los productos existentes
        $calzados = Calzado::all();

        // Retornar la vista con la lista de productos
        return view('admin.compra.store', compact('calazados'));
    }
    public function index()
    {
        $compras = LoteMercaderia::with(['marca'])->get();
        return view('admin.compra.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = Pais::all();
        $marcas = Marca::all();
        $calzados = Calzado::all();
        return view('admin.compra.create', compact('marcas','paises','calzados'));
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
