<?php

namespace App\Http\Controllers\Admin\Venta;
use Carbon\Carbon;

use App\Models\NotaVenta;
use App\Models\Credito;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function store(Request $request){
        
        
        Credito::create([
            'nro_venta' => $request->nro_venta,
            'fecha' => Carbon::now()->format('Y-m-d'),
            'monto_c' => $request->monto_c,
        ]);
        return redirect()->back();
    }
}
