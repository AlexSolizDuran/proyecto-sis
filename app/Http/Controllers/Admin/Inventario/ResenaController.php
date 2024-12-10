<?php

namespace App\Http\Controllers\Admin\Inventario;
use Carbon\Carbon;

use App\Models\RegistroVenta;
use App\Models\Resena;
use App\Models\Calzado;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    public function store(Request $request){
        Resena::create([
            'nro_reg' => $request->nro_reg,
            'comentario' => $request->comentario,
            'estrella' => $request->estrella,
        ]);
        return redirect()->back();
    }
    public function mostrarComentarios(Request $request )
    {
        $orden = $request->input('orden', 'desc'); // Obtiene la opción de orden, por defecto 'desc'
        
        $comentarios = RegistroVenta::where('cod_calzado', $request->cod)
                                ->with('resena')
                                ->get()
                                ->pluck('resena')
                                ->filter()
                                ->sortByDesc('estrella'); // Ordena por la cantidad de estrellas

        if ($orden == 'asc') {
            $comentarios = $comentarios->sortBy('estrella'); // Orden ascendente (menor a mayor estrellas)
        } else {
            $comentarios = $comentarios->sortByDesc('estrella'); // Orden descendente (mayor a menor estrellas)
        }
        $calzado = Calzado::find($request->cod);

        return view('cliente.zapato.show', compact('comentarios','calzado'));
    }
}
