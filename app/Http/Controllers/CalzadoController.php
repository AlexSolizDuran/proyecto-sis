<?php

namespace App\Http\Controllers;
use App\Models\Calzado;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Material;
use App\Models\LoteMercaderia;

use Illuminate\Http\Request;

class CalzadoController extends Controller
{
    public function index()
    {
        // Obtener todos los calzados
        $calzados = Calzado::with(['modelo', 'material', 'talla'])->get();

        // Pasar los calzados a la vista
        return view('admin.calzado.index', compact('calzados'));
    }

    public function create(){
        
        $marcas = Marca::all(); // Obtener todas las marcas
        $modelos = Modelo::all(); // Obtener todos los modelos
        $tallas = Talla::all(); // Obtener todas las tallas
        $materiales = Material::all(); // Obtener todos los materiales
        $lotes = LoteMercaderia::all();
    
        return view('admin.calzado.create', compact('marcas', 'modelos', 'tallas', 'materiales','lotes'));
    }
    public function store(Request $request)
    {
        $request->validate([
        'cod' => 'required|integer',
        'genero' => 'required|string',
        'precio_unidad' => 'required|numeric',
        'cantidad_pares' => 'required|integer',
        'cod_lote' => 'required|integer',
        'cod_modelo' => 'required|integer',
        'cod_talla' => 'required|integer',
        'cod_material' => 'required|integer',
        ]);

        Calzado::create($request->all());

        return redirect()->route('admin.calzado.index')->with('success', 'Producto creado exitosamente.');
    }
    public function show(Calzado $calzado){

        $calzado->load(['modelo', 'talla', 'material']);

        return view ('admin.calzado.show', compact('calzado'));
    }
    public function edit(Calzado $calzado){

        
        $modelos = Modelo::all(); // Suponiendo que tienes un modelo Modelo
        $tallas = Talla::all(); // Suponiendo que tienes un modelo Talla
        $materiales = Material::all(); // Suponiendo que tienes un modelo Material

        return view('admin.calzado.edit', compact('calzado', 'modelos', 'tallas', 'materiales'));
    }
    public function update(Request $request, Calzado $calzado){

        $validatedData = $request->validate([
            'cod' => 'required|numeric',
            'genero' => 'required|string',
            'precio_unidad' => 'required|numeric',
            'cantidad_pares' => 'required|numeric',
            'cod_modelo' => 'required|exists:modelo,cod',
            'cod_talla' => 'required|exists:talla,cod',
            'cod_material' => 'required|exists:material,cod',
        ]);

        $calzado->cod = $validatedData['cod'];
        $calzado->genero = $validatedData['genero']; // Almacenará como 'M', 'F' o 'U' automáticamente
        $calzado->precio_unidad = $validatedData['precio_unidad'];
        $calzado->cantidad_pares = $validatedData['cantidad_pares'];
        $calzado->cod_modelo = $validatedData['cod_modelo'];
        $calzado->cod_talla = $validatedData['cod_talla'];
        $calzado->cod_material = $validatedData['cod_material'];

    
        $calzado->save();

    
        return redirect()->route('admin.calzado.index')->with('success', 'Calzado actualizado con éxito.');

    }
    public function destroy(Calzado $calzado){
        $calzado->delete();
        return redirect()->route('admin.calzado.index')->with('success','Calzado eliminado con exito');
    }
     
    


    public function lista(){
        $calzados = Calzado::with(['modelo', 'material', 'talla'])->get();

        // Pasar los calzados a la vista
        return view('cliente.index', compact('calzados'));
    }
    
}
