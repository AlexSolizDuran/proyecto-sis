@extends('layout')

@section('contenido')
<div class="container">
    <h1>Detalles de la Venta</h1>
        <p>Numero de Venta: {{ $venta->nro }}</p>
        <p>Fecha: {{ $venta->fecha }}</p>
        <p>Cliente: {{ $venta->ci_cliente }}</p>
        <p>Admin: {{ $venta->cod_admin}}</p>

    <h2>Registro de Ventas</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Codigo de venta</th>
            <th>Codigo de Producto</th>
            <th>Precio</th>
        </tr>
        </thead>
    <tbody>
        @foreach ($venta->registroventa as $registro)
            <tr>
                <td>{{ $registro->cod }}</td>
                <td>{{ $registro->cod_calzado }}</td>
                <td>{{ $registro->precio_venta }}</td>
            </tr>
        @endforeach
            <td>Monto total: {{ $venta->monto_total }}</td>
    </tbody>
</table>

   
    <a href="{{ route('admin.venta.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
    
@endsection