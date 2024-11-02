<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\LoteMercaderia;
use App\Models\RegistroLote;
use App\Models\Marca;
use App\Models\Pais;
use App\Models\Calzado;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
    $materiales = Material::all();
    $tallas = Talla::all();

    // Obtener el código de la marca desde la sesión
    $marcaCod = session()->get('lote')['marca']['cod'] ?? null;

    // Filtrar modelos según la marca
    $modelos = Modelo::when($marcaCod, function ($query) use ($marcaCod) {
        return $query->where('cod_marca', $marcaCod);
    })->get();

    // Consultar los calzados filtrados por marca
    $calzados = Calzado::when($marcaCod, function ($query) use ($marcaCod) {
        return $query->whereHas('modelo', function ($q) use ($marcaCod) {
            $q->where('cod_marca', $marcaCod);
        });
    })->get();

    return view('admin.compra.create', compact('tallas', 'materiales', 'modelos', 'marcas', 'paises', 'calzados'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lote = session()->get('lote');
        
        DB::table('lote_mercaderia')->insert([
            'cantidad_total_pares' => $lote['cantidad_total'],
            'impuestos' => $lote['impuestos'],
            'precio_compra' => $lote['precio_compra'],
            'precio_logistica' => $lote['precio_logistica'],
            'fecha_compra'=> Carbon::now()->format('Y-m-d'),
            'cod_marca'=> $lote['marca']->cod,
        ]);
        $nro_lote = DB::getPdo()->lastInsertId();
        DB::table('compra_prov')->insert([
            'cod_lote' => $nro_lote,
            'cod_pais' => $lote['pais']->cod,
            'NIT' => $lote['nit'],
            'nombre'=>$lote['proveedor'],
        ]);
        $compra = session()->get('compra', []);
        foreach ($compra as $item) {
            DB::table('registro_lote')->insert([
                'cod_calzado' => $item['calzado']->cod, // Usando el id de la nota de venta
                'cod_lote' => $nro_lote,
                'cantidad' => $item['cantidad'],
                'precio_compra' => 0,
            ]);
        }
        session()->forget('lote');
        session()->forget('compra');
    
        return redirect()->route('admin.compra.index')->with('success', 'Lote creado con éxito.');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $compra = LoteMercaderia::findOrFail($id);
        // Accede directamente a la relación sin load
        $registros = $compra->registrolote; 
    
        return view('admin.compra.show', compact('compra', 'registros'));
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
        $compra = LoteMercaderia::findOrFail($id);
        $compra->delete();
        return redirect()->route('admin.compra.index')->with('success','Lote eliminado exitosamente');
 
    }
    public function lote(Request $request)
    {
        $request->validate([
            'marca'=> 'required',
            'pais'=> 'required',
            'nit' => 'required|string|min:1',
            'proveedor' =>'required',
            'cantidad_total' => 'required',
            'impuestos' => 'required',
            'precio_compra'=> 'required',
            'precio_logistica'=> 'required',
        ]);

        $pais = Pais::where('cod', $request->pais)->first();
        $marca = Marca::where('cod', $request->marca)->first();

        $lote = [
            'nit' => $request->nit,
            'marca' => $marca,
            'pais' => $pais,
            'proveedor' => $request->proveedor,
            'cantidad_total' => $request->cantidad_total,
            'impuestos' => $request->impuestos,
            'precio_compra' => $request->precio_compra,
            'precio_logistica' => $request->precio_logistica,
        ];
        
        // Almacenar el arreglo en la sesión bajo la clave 'lote'
        session()->put('lote', $lote);


        return redirect()->route('admin.compra.create')->with('success','');
    }
    public function filtrar(Request $request)
    {
        
        $materiales = Material::all();
        $tallas = Talla::all();
        $query = Calzado::query();
        $modelos = Modelo::where('cod_marca', session('lote.marca.cod'))->get(); // Obtener solo los modelos de la marca en la sesión

        if (session('lote.marca.cod')) {
            $query->whereHas('modelo', function ($q) {
                $q->where('cod_marca', session('lote.marca.cod'));
            });        }

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
       
        return view('admin.compra.create', compact('calzados', 'modelos', 'materiales', 'tallas',));
    
    }
    public function addlote(Request $request)
    {
        $calzadoId = $request->cod; // ID del calzado
        $cantidad = $request->cantidad; // Cantidad del calzado
        $calzado = Calzado::find($calzadoId); // Obtener el calzado por ID

        // Obtener la compra (pedido) de la sesión o inicializarla como un array vacío
        $compra = session()->get('compra', []);

        // Agregar o sobrescribir el calzado en la compra
        $compra[$calzadoId] = [
        'calzado' => $calzado,
        'cantidad' => $cantidad, // Se asigna la cantidad directamente
        ];

    // Guardar la compra actualizada en la sesión
    session()->put('compra', $compra);

    return redirect()->route('admin.compra.create')->with('success', 'Calzado agregado a la compra correctamente.');

    }
    public function cancelar()
    {
        session()->forget('lote');
        session()->forget('compra');

        return redirect()->route('admin.compra.create')->with('success', 'Carrito cancelado correctamente.');
 
    }
}
