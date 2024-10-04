@extends('layout')

@section('contenido')
    
<div>
    <h1 class="centrar">Lista de Calzados</h1>
    <table class="tabla ">
        <thead>
            <tr>
                <th>Código</th>
                <th>Género</th>
                <th>Precio por Unidad</th>
                <th>Cantidad de Pares</th>
                <th>Código Modelo</th>
                <th>Código Talla</th>
                <th>Código Material</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calzados as $calzado)
                <tr>
                    <td>{{ $calzado->cod }}</td>
                    <td>{{ $calzado->genero }}</td>
                    <td>{{ $calzado->precio_unidad }} Bs</td>
                    <td>{{ $calzado->cantidad_pares }}</td>   
                    <td>{{ $calzado->modelon() }}</td>
                    <td>{{ $calzado->tallan() }}</td>
                    <td>{{ $calzado->materialn() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
