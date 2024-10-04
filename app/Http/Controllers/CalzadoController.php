<?php

namespace App\Http\Controllers;
use App\Models\Calzado;
use Illuminate\Http\Request;

class CalzadoController extends Controller
{
    public function index()
    {
        // Obtener todos los calzados
        $calzados = Calzado::with(['modelo', 'material', 'talla'])->get();

        // Pasar los calzados a la vista
        return view('cliente.index', compact('calzados'));
    }
    public function create(){
        return view('admin.calzados.create');
    }
}
