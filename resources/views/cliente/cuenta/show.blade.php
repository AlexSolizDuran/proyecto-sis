@extends('layout')

@section('contenido')
<div class="container">
    <h1>Detalles de la cuenta: </h1>

    <div class="card" >
        
        <div class="card-body">
            <p class="card-text"><strong>C.I. : </strong> {{ $persona->ci }}</p>
            <p class="card-text"><strong>Nombres: </strong> {{ $persona->nombre }}</p>
            <p class="card-text"><strong>Apellidos: </strong> {{ $persona->apellido}}</p>
            <p class="card-text"><strong>Telefono: </strong> {{ $persona->cel}} </p>
            <p class="card-text"><strong>Direccion: </strong> {{ $persona->direccion}}</p>
            <p class="card-text"><strong>Email: </strong> {{ $persona->email }}</p>

        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-secondary ">Volver</a>
    <a href="{{ route('cliente.cuenta.edit', $persona->ci) }}" class="btn btn-primary ">Editar</a>
    <a href="{{ route('password.change.form',) }}" class="btn btn-primary ">Cambiar Contraseña</a>
    @if ($persona->cliente && $persona->cliente->notaVentas && !$persona->cliente->notaVentas->isEmpty())

    <table class="table">
        <thead>
        <tr>
            <th>Codigo de venta</th>
            <th>Fecha</th>
            <th>Monto Total</th>
            <th>Descuento Total</th>
            <th>Total a Cobrar</th>
            <th>Vista</th>
        </tr>
        </thead>
    <tbody>
            @foreach ($persona->cliente->notaVentas as $venta)
        <tr>
            <td>{{ $venta->nro }}</td>
            <td>{{ $venta->fecha }}</td>
            <td>{{ $venta->monto_total }}</td>
            <td>{{ $venta->descuento_total }}</td>
            <td>{{ $venta->monto_total - $venta->descuento_total }}</td>
            <td>
            <a href="{{ route('admin.venta.factura', $venta) }}" target="_blank" class="btn btn-warning btn-sm">factura</a>
            
            <a href="{{ route('cliente.detalle', $venta) }}" class="btn btn-danger btn-sm">Ver</a>
    
        </td>
        </tr>
            @endforeach
    </tbody>
    </table>
    @endif


</div>
    
@endsection