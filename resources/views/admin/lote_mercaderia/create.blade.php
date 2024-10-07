@extends('layout')
@section('contenido')

<form action="{{ route('lote_mercaderia.store') }}" method="POST" class="formulario">
    @csrf
    <div class="form-group">
        <label for="cod">Código</label>
        <input type="number" name="cod" id="cod" class="form-control" required>
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
        <label for="fecha_compra">Fecha de Compra</label>
        <input type="date" name="fecha_compra" id="fecha_compra" class="form-control" required>
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

    <button type="submit" >Crear Lote de Mercadería</button>
</form>
@endsection