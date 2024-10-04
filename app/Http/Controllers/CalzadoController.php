<?php

namespace App\Http\Controllers;
use App\Models\Calzado;
use Illuminate\Http\Request;

class CalzadoController extends Controller
{
    public function index()
    {
        // Obtener todos los calzados
        $calzados = Calzado::with(['loteMercaderia', 'modelo', 'talla', 'material'])->get();

        // Pasar los calzados a la vista
        return view('index', compact('calzados'));
    }
}
