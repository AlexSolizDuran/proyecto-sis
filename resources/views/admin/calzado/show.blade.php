@extends('layout')

@section('contenido')
<div class="container">
    <h1>Detalles del Calzado: </h1>

    <div class="card" >
        
        <div class="card-body">

            <p class="card-text"><strong>Codigo</strong> {{ $calzado->cod }}</p>
            <p class="card-text"><strong>Genero:</strong> {{ $calzado->genero }}</p>
            <p class="card-text"><strong>Precio:</strong> {{ $calzado->precio_unidad }} USD</p>
            <p class="card-text"><strong>Cantidad de pares</strong> {{ $calzado->cantidad_pares }}</p>
            <p class="card-text"><strong>Modelo:</strong> {{ $calzado->modelo->nombre }}</p>
            <p class="card-text"><strong>Talla:</strong> {{ $calzado->talla->numero }}</p>
            <p class="card-text"><strong>Material:</strong> {{ $calzado->material->nombre}}</p>
        </div>
    </div>

    {{-- Botón para volver a la lista de calzados --}}
    <a href="{{ route('admin.calzado.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
    
@endsection