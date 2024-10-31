<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Material;
use App\Models\Calzado;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class ZapatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $modelos = Modelo::all();
        $materiales = Material::all();
        $tallas = Talla::all();
        $marcas = Marca::all();
        $query = Calzado::query();
        //filtrar por marca
        if ($request->filled('cod_marca')) {
            $query->whereHas('modelo.marca', function ($q) use ($request) {
                $q->where('cod', $request->cod_marca); // Cambia 'id' al nombre real de la columna de la marca
            });
        }
        // Filtrar por modelo
        if ($request->filled('cod_modelo')) {
            $query->where('cod_modelo', $request->cod_modelo);
        }
    
        // Filtrar por material
        if ($request->filled('cod_material')) {
            $query->where('cod_material', $request->cod_material);
        }
        
        // Filtrar por talla
        if ($request->filled('cod_talla')) {
            $query->where('cod_talla', $request->cod_talla);
        }
    
        $calzados = $query->get();
    
        return view('cliente.zapato.index', compact('calzados', 'modelos', 'materiales', 'tallas','marcas'));
   
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($cod)
    {
        $calzado = Calzado::find($cod);
        $ci= Auth::check() ? Auth::user()->persona->ci : null;

        Bitacora::create([
            'ci' => $ci,
            'ip' => request()->ip(),
            'accion' => 'Accedio al detalle del calzado con codigo : '. $cod, // Cambia esto según la acción
            'fecha' => now()->format('Y-m-d'), // Fecha actual
            'hora' => now()->format('H:i:s'), // Hora actual
        ]);
        
        return view ('cliente.zapato.show', compact('calzado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calzado $calzado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calzado $calzado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calzado $calzado)
    {
        //
    }
}
