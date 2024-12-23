<?php

namespace App\Http\Controllers\Admin\Venta;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Material;
use App\Models\Calzado;
use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\Administrador;
use App\Models\NotaVenta;
use App\Models\RegistroVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function inicio(Request $request)
    {
        $fechaLimite = Carbon::now()->subMonths(10);

        $ofertas = Calzado::whereHas('lotes.loteMercaderia', function ($query) use ($fechaLimite) {
            $query->where('fecha_compra', '<', $fechaLimite);
        })->inRandomOrder()->take(10)->get();

        $calzados = Calzado::whereHas('lotes.loteMercaderia', function ($query) use ($fechaLimite) {
            $query->where('fecha_compra', '>=', $fechaLimite);
        })->inRandomOrder()->take(10)->get();
        
        return view('welcome',compact('calzados','ofertas'));
    }
    public function pedido()
    {
        $stripeKey = env('STRIPE_KEY');
        return view('cliente.zapato.carro', compact('stripeKey'));
    }
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ci' => 'required|integer',
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'direccion' => 'required|string|max:60',
            'cel' => 'required|integer',
        ]);
    
        // Verificar si el cliente ya existe por su CI
        $cliente = Cliente::where('ci_persona', $validated['ci'])->first();
    
        if (!$cliente) {
            // Si no existe, crear un nuevo cliente
            $cliente = Persona::create([
                'ci' => $validated['ci'],
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'],
                'email' => $validated['email'],
                'direccion' => $validated['direccion'],
                'cel' => $validated['cel'],
            ]);
            Cliente::create([
                'ci_persona'=> $validated['ci']
            ]);
        }

        $carro = session()->get('carro', []);
        $nro_venta = NotaVenta::create([
            'ci_cliente' => $request->ci,
            'fecha' => Carbon::now()->format('Y-m-d'), // Formato de fecha
            'monto_total' => 0,
            'cantidad' => 0,
            'descuento_total' => 0,
            'estado' => 0, // sin cancelar
            'tipo_pago'=> 'c',
            'cod_admin' => 'AD-1',
        ]);
        
        foreach ($carro as $item) {
            $registroVenta = RegistroVenta::create([
                'nro_venta' => $nro_venta->nro, // Usando el id de la nota de venta
                'cod_calzado' => $item['calzado']->cod,
                'cantidad' => $item['cantidad'],
                'precio_venta' => $item['calzado']->precio_venta,
                'descuento' => 0,
            ]);
        }
        $nro_venta = NotaVenta::where('nro', $nro_venta->nro)->first();

        $montoTotal = $nro_venta->monto_total - $nro_venta->descuento_total;
        session()->put('montoTotal',$montoTotal);
        
        $ci = Auth::check() ? Auth::user()->ci : null;
        if (!Auth::check() || Auth::user()->tipo == 'C') {
            Bitacora::create([
                'ci' => $ci,
                'ip' => request()->ip(),
                'accion' => 'Realizo una compra con CI :' . $request->ci,
                'fecha' => now()->format('Y-m-d'), // Fecha actual
                'hora' => now()->format('H:i:s'), // Hora actual
            ]);
        }
        return redirect()->route('paypal.pay');

    }

    /**
     * Display the specified resource.
     */
    public function show($cod)
    {
        $calzado = Calzado::find($cod);
        $ci = Auth::check() ? Auth::user()->ci : null;

        // Verifica si el usuario está autenticado y su rol
        if (!Auth::check() || Auth::user()->tipo == 'C') {
            Bitacora::create([
                'ci' => $ci,
                'ip' => request()->ip(),
                'accion' => 'Accedió al detalle del calzado con código: ' . $cod,
                'fecha' => now()->format('Y-m-d'), // Fecha actual
                'hora' => now()->format('H:i:s'), // Hora actual
            ]);
        }
        $comentarios = RegistroVenta::where('cod_calzado', $cod)
                            ->with('resena') // Carga las reseñas relacionadas
                            ->get()
                            ->pluck('resena') // Obtiene solo las reseñas
                            ->filter(); // Filtra los valores nulos
        return view ('cliente.zapato.show', compact('calzado','comentarios'));
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
    public function añadir(Request $request)
    {
        $calzadoId = $request->cod;
        $cantidad = $request->cantidad;
        $calzado = Calzado::where('cod', $request->cod)->first();
        $carro = session()->get('carro', []);
        $carro[$calzadoId] = [
            'calzado'=> $calzado,
            'cantidad' => $cantidad,
        ];
        session()->put('carro', $carro);  

        $ci = Auth::check() ? Auth::user()->ci : null;
        if (!Auth::check() || Auth::user()->tipo == 'C') {
            Bitacora::create([
                'ci' => $ci,
                'ip' => request()->ip(),
                'accion' => 'Añadio a su carrito el calzado con código: ' . $calzadoId,
                'fecha' => now()->format('Y-m-d'), // Fecha actual
                'hora' => now()->format('H:i:s'), // Hora actual
            ]);
        }
        return redirect()->back()->with('success', 'Calzado agregado correctamente.');
    }
    public function quitar($calzadoCod)
    {
    // Recuperar el carro de la sesión
        $carrito = session()->get('carro', []);
        
        // Eliminar el calzado específico del carrito
        if (isset($carrito[$calzadoCod])) {
            unset($carrito[$calzadoCod]);
        }

        // Volver a guardar el carro actualizado en la sesión
        session()->put('carro', $carrito);
        $ci = Auth::check() ? Auth::user()->ci : null;
        if (!Auth::check() || Auth::user()->tipo == 'C') {
            Bitacora::create([
                'ci' => $ci,
                'ip' => request()->ip(),
                'accion' => 'Elemino de su carrito el calzado con código: ' . $calzadoCod,
                'fecha' => now()->format('Y-m-d'), // Fecha actual
                'hora' => now()->format('H:i:s'), // Hora actual
            ]);
        }

        // Redirigir a la misma página con un mensaje
        return redirect()->back()->with('success', 'El calzado ha sido eliminado del carrito.');
    }
    
    public function cancelar(){
        // Eliminar el carrito de la sesión
        session()->forget('carro');
        return redirect()->back()->with('success', 'Carrito cancelado correctamente.');
    }
}
