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


    <table class="table">
        <thead>
        <tr>
            <th>Codigo de venta</th>
            <th>Fecha</th>
            <th>Monto Total</th>
            <th>Ver</th>
        </tr>
        </thead>
    <tbody>
            @foreach ($cliente->notaVentas as $venta)
        <tr>
            <td>{{ $venta->nro }}</td>
            <td>{{ $venta->fecha }}</td>
            <td>{{ $venta->monto_total }}</td>
            <td><a href="{{ route('admin.venta.show', $venta) }}" class="btn btn-info btn-sm">Ver</a></td>
        </tr>
            @endforeach
    </tbody>
    </table>
</div>

    
@endsection