@extends('layout')

@section('contenido')
    
<div class="container">
    <h1 class="centrar">Lista de Calzados</h1>
    <table class="table ">
        <thead>
            <tr>
                <th>Código</th>
                <th>Género</th>
                <th>Precio por Unidad</th>
                <th>Cantidad de Pares</th>
                <th>Modelo</th>
                <th>Talla</th>
                <th>Material</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calzados as $calzado)
                <tr>
                    <td>{{ $calzado->cod }}</td>
                    <td>{{ $calzado->genero }}</td>
                    <td>{{ $calzado->precio_unidad }} Bs</td>
                    <td>{{ $calzado->cantidad_pares }}</td>   
                    <td>{{ $calzado->modelo->nombre }}</td>
                    <td>{{ $calzado->talla->numero }}</td>
                    <td>{{ $calzado->material->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
