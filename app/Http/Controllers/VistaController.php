<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calzado;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Material;


class VistaController extends Controller
{
    public function index(Request $request){
        $modelos = Modelo::all();
        $materiales = Material::all();
        $tallas = Talla::all();
        $query = Calzado::query();

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
    
        return view('cliente.index', compact('calzados', 'modelos', 'materiales', 'tallas'));
    }
}
