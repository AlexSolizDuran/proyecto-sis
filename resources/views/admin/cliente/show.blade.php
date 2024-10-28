@extends('layout')

@section('contenido')
<div class="container">
    <h1>Detalles del Cliente: </h1>

    <div class="card" >
        
        <div class="card-body">
            <p class="card-text"><strong>Codigo: </strong> {{ $cliente->persona->ci }}</p>
            <p class="card-text"><strong>Nombres: </strong> {{ $cliente->persona->nombre }}</p>
            <p class="card-text"><strong>Apellidos: </strong> {{ $cliente->persona->apellido}}</p>
            <p class="card-text"><strong>Telefono: </strong> {{ $cliente->persona->cel}} </p>
            <p class="card-text"><strong>Direccion: </strong> {{ $cliente->persona->direccion}}</p>
            <p class="card-text"><strong>Email: </strong> {{ $cliente->persona->email }}</p>

        </div>
    </div>

    {{-- Botón para volver a la lista de calzados --}}
    <a href="{{ route('admin.cliente.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
    
@endsection