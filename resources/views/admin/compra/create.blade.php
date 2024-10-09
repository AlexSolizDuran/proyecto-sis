@extends('layout')
@section('contenido')

<form action="{{ route('admin.compra.store') }}" method="POST" class="formulario">
    @csrf

    <div class="form-group">
        <label for="pais">Pais</label>
        <select name="pais" id="pais" class="form-control" required>
            @foreach($paises as $pais)
                <option value="{{ $pais->cod }}">{{ $pais->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="cantidad_total_pares">Cantidad Total de Pares</label>
        <input type="number" name="cantidad_total_pares" id="cantidad_total_pares" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="impuestos">Impuestos</label>
        <input type="number" step="0.01" name="impuestos" id="impuestos" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="precio_compra">Precio de Compra</label>
        <input type="number" step="0.01" name="precio_compra" id="precio_compra" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="precio_logistica">Precio de Logística</label>
        <input type="number" step="0.01" name="precio_logistica" id="precio_logistica" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="cod_marca">Marca</label>
        <select name="cod_marca" id="cod_marca" class="form-control" required>
            @foreach($marcas as $marca)
                <option value="{{ $marca->cod }}">{{ $marca->nombre }}</option>
            @endforeach
        </select>
    </div>
    <button type="button" >Mostrar Lista de Productos</button>
    
</form>

@endsection