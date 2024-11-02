<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $bitacoras = Bitacora::all();

        // Pasar las entradas a la vista
        return view('admin.bitacora.index', compact('bitacoras'));
    }

    public function destroy(Bitacora $bitacora)
    {
        //
    }
}
