@extends('layout')
@section('contenido')
<div>
<form  method="POST" class="formulario-calzado">
    @csrf <!-- Token de seguridad para formularios en Laravel -->
    
    <label for="cod">Código:</label>
    <input type="number" id="cod" name="cod" required>

    <label for="genero">Género:</label>
    <select id="genero" name="genero" required>
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
    </select>

    <label for="precio_unidad">Precio Unidad:</label>
    <input type="number" id="precio_unidad" name="precio_unidad" step="0.01" required>

    <label for="cantidad_pares">Cantidad de Pares:</label>
    <input type="number" id="cantidad_pares" name="cantidad_pares" required>

    <label for="cod_lote">Código de Lote:</label>
    <input type="number" id="cod_lote" name="cod_lote" required>

    <label for="cod_modelo">Código de Modelo:</label>
    <input type="number" id="cod_modelo" name="cod_modelo" required>

    <label for="cod_talla">Código de Talla:</label>
    <input type="number" id="cod_talla" name="cod_talla" required>

    <label for="cod_material">Código de Material:</label>
    <input type="number" id="cod_material" name="cod_material" required>

    <button type="submit">Crear Producto</button>
</form>

@endsection