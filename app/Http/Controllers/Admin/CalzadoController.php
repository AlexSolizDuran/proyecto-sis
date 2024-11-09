<?php

namespace App\Http\Controllers\Admin;
use App\Models\Calzado;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Material;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;

use App\Models\LoteMercaderia;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalzadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $modelos = Modelo::all();
        $materiales = Material::all();
        $tallas = Talla::all();
        $marcas = Marca::all();
        $query = Calzado::query();

        // Filtrar por marca
        if ($request->filled('cod_marca')) {
            $query->whereHas('modelo.marca', function ($q) use ($request) {
                $q->where('cod', $request->cod_marca); // Cambia 'id' al nombre real de la columna de la marca
            });
        }
        //filtrar por modelo
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
    
        return view('admin.calzado.index', compact('calzados', 'modelos', 'materiales', 'tallas','marcas'));
    }
    
    public function create(){
        
        $marcas = Marca::all(); // Obtener todas las marcas
        $modelos = Modelo::all(); // Obtener todos los modelos
        $tallas = Talla::all(); // Obtener todas las tallas
        $materiales = Material::all(); // Obtener todos los materiales
        $colores = Color::all();
        return view('admin.calzado.create', compact('marcas', 'modelos', 'tallas', 'materiales','colores'));
    }
    public function store(Request $request)
    {
        $request->validate([
        'genero' => 'required|string',
        'cod_modelo' => 'required|integer',
        'cod_talla' => 'required|integer',
        'cod_material' => 'required|integer',
        ]);
        $path = null;
        if ($request->hasFile('imagen')) {
            // Guardar la imagen en el almacenamiento público
            $path = $request->file('imagen')->store('images/calzados', 'public');
            // Se agrega la ruta al request
        }
        
        
        Calzado::create(array_merge(
            $request->all(),
            [
                'imagen'=> $path,
                'cantidad_pares' => 0,
                'precio_unidad' => 0,
            ]
        ));
        $colores = $request->selected_colors;
        $cod_calzado = DB::getPdo()->lastInsertId();
        if (!empty($colores)) {
            // Dividir los colores en un array
            $coloresArray = explode(',', $colores);
    
            // Hacer un foreach para guardar cada color relacionado con el calzado
            foreach ($coloresArray as $color) {
                // Guardar la relación en la tabla pivot
                DB::table('color_calzado')->insert([
                    'cod_calzado' => $cod_calzado, // Asumiendo que esta es la columna en la tabla pivot
                    'cod_color' => $color, // Suponiendo que 'color_id' es la columna en la tabla pivot
                ]);
            }
        }
        
        
        if ($request->input('from_modal')) {
            return redirect()->back()->with('success', 'Producto creado exitosamente.');
        } else {
            return redirect()->route('admin.calzado.index')->with('success', 'Producto creado exitosamente.');
        } 
    }

    public function show(Calzado $calzado){

        return view ('admin.calzado.show', compact('calzado'));
    }
    public function edit(Calzado $calzado){

        $marcas = Marca::all();
        $modelos = Modelo::all(); // Suponiendo que tienes un modelo Modelo
        $tallas = Talla::all(); // Suponiendo que tienes un modelo Talla
        $materiales = Material::all(); // Suponiendo que tienes un modelo Material
        $colores = Color::all();
        $selected_colors = $calzado->colores->pluck('cod')->toArray(); // array de códigos de color seleccionados

        
        return view('admin.calzado.edit', compact('marcas','calzado', 'modelos', 'tallas', 'materiales','colores','selected_colors'));
    }
    public function update(Request $request, Calzado $calzado){

        $validatedData = $request->validate([
            'genero' => 'required|string',
            'precio_unidad' => 'required|numeric',
            'cantidad_pares' => 'required|numeric',
            'cod_modelo' => 'required',
            'cod_talla' => 'required',
            'cod_material' => 'required',
        ]);
        $selectedColors = explode(',', $request->input('selected_colors'));
        $selectedColors = array_filter($selectedColors); // Esto elimina elementos vacíos

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen antigua si existe
            if ($calzado->imagen && Storage::exists($calzado->imagen)) {
                Storage::delete($calzado->imagen);
            }
    
            // Guardar la nueva imagen
            $path = $request->file('imagen')->store('images/calzados', 'public');
            $calzado->imagen = $path;
        }

        $calzado->genero = $validatedData['genero']; // Almacenará como 'M', 'F' o 'U' automáticamente
        $calzado->precio_unidad = $validatedData['precio_unidad'];
        $calzado->cantidad_pares = $validatedData['cantidad_pares'];
        $calzado->cod_modelo = $validatedData['cod_modelo'];
        $calzado->cod_talla = $validatedData['cod_talla'];
        $calzado->cod_material = $validatedData['cod_material'];
        if (empty($selectedColors)) {
            // Si no hay colores seleccionados, simplemente elimina las relaciones
            $calzado->colores()->detach(); // Esto eliminará todas las relaciones.
        } else {
            // Si hay colores seleccionados, sincroniza
            $calzado->colores()->sync($selectedColors);
        }
        $calzado->save();

        return redirect()->route('admin.calzado.index')->with('success', 'Calzado actualizado con éxito.');

    }

    public function destroy(Calzado $calzado){
        $calzado->delete();
        return redirect()->route('admin.calzado.index')->with('success','Calzado eliminado con exito');
    }
     
    
}

