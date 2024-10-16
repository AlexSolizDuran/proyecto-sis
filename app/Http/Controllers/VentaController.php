<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\NotaVenta;
use App\Models\RegistroVenta;
use App\Models\Calzado;
use App\Models\Cliente;
use App\Models\Modelo;
use App\Models\Material;
use App\Models\Talla;
use App\Models\Persona;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function buscarCliente(Request $request)
    {
        $request->validate([
            'ci_persona' => 'required|string|min:1',
        ]);
        
        $cliente = Cliente::where('ci_persona', $request->ci_persona)->first();
        if (!$cliente) {
            return back()->with('error', 'Cliente no encontrado.');
        }
        $persona = $cliente->persona;
        session()->put('ci_persona', $cliente->ci_persona);
        session()->put('persona', $persona);
        return redirect()->route('admin.venta.create');
    }
    public function addCalzado(Request $request)
    {
        $calzadoId = $request->cod;
        $cantidad = $request->cantidad;
        $calzado = Calzado::where('cod', $request->cod)->first();
        $carrito = session()->get('carrito', []);
        $carrito[$calzadoId] = [
            'calzado'=> $calzado,
            'cantidad' => $cantidad,
        ];
        session()->put('carrito', $carrito);  
        $calzados = Calzado::all();
        return redirect()->route('admin.venta.create')->with('success', 'Calzado agregado correctamente.');
    }
    public function cancelarcarrito(){
        // Eliminar el carrito de la sesión
        session()->forget('ci_persona');
        session()->forget('carrito');
        session()->forget('persona');
        return redirect()->route('admin.venta.create')->with('success', 'Carrito cancelado correctamente.');
    }
    public function index()
    {
        $ventas = NotaVenta::all();
        return view('admin.venta.index',compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    $carrito = session()->get('carrito', []);
    $calzados = Calzado::all();
    $modelos = Modelo::all();
    $materiales = Material::all();
    $tallas = Talla::all();
    return view('admin.venta.create', [
        'carrito' => $carrito,
        'calzados' => $calzados,
        'modelos' => $modelos,
        'materiales' => $materiales,
        'tallas' => $tallas
    ]);
    }
    public function store(Request $request)
    {
        $cliente = session()->get('ci_persona');
        $carrito = session()->get('carrito', []);

        $nro_venta = DB::table('nota_venta')->insert([
            'ci_cliente' => $cliente,
            'fecha' => Carbon::now()->format('Y-m-d'), // Formato de fecha
            'monto_total' => 0,
            'cantidad' => 0,
            'cod_admin' => Auth::user()->cod,
        ]);
        
        $carrito = session()->get('carrito', []);
        foreach ($carrito as $item) {
            DB::table('registro_venta')->insert([
                'nro_venta' => $nro_venta, // Usando el id de la nota de venta
                'cod_calzado' => $item['calzado']->cod,
                'cantidad' => $item['cantidad'],
                'precio_venta' => $item['calzado']->precio_unidad,
            ]);
        }
        session()->forget('ci_persona');
        session()->forget('carrito');
        session()->forget('persona');
    return redirect()->route('admin.venta.index')->with('success', 'Venta realizada correctamente.');
    }

    public function filtrar(Request $request)
    {
        $modelos = Modelo::all();
        $materiales = Material::all();
        $tallas = Talla::all();
        $query = Calzado::query();
        if ($request->filled('cod_modelo')) {
            $query->where('cod_modelo', $request->cod_modelo);
        }
        if ($request->filled('cod_material')) {
            $query->where('cod_material', $request->cod_material);
        }
        if ($request->filled('cod_talla')) {
            $query->where('cod_talla', $request->cod_talla);
        }
    
        $calzados = $query->get();
    
        return view('admin.venta.create', compact('calzados', 'modelos', 'materiales', 'tallas'));
    }

    public function show(string $id)
    {
        $venta = NotaVenta::findOrFail($id);

        $venta->load('registroventa');

        return view('admin.venta.show', compact('venta'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $venta = NotaVenta::findOrFail($id);
        $venta->delete();
        return redirect()->route('admin.venta.index')->with('success','Venta a sido eliminado exitosamente');
 
    }
}
