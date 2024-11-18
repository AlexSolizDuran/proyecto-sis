@extends('layout')

@section('contenido')
<div class="container">
    <h1>Detalles del Lote</h1>
    <p><strong>Número de Lote:</strong> {{ $compra->cod }}</p>
    <p><strong>Fecha:</strong> {{ $compra->fecha_compra }}</p>
    <p><strong>Cantidad total:</strong> {{ $compra->cantidad_total_pares }}</p>
    <p><strong>Impuestos:</strong> {{ $compra->impuestos }}</p>
    <p><strong>Costo de compra:</strong> {{ $compra->costo_compra }}</p>
    <p><strong>Costo logística:</strong> {{ $compra->costo_logistica }}</p>
    <p><strong>Marca:</strong> {{ $compra->marca ? $compra->marca->nombre : 'No disponible' }}</p>

    <h2>Registro de Compras</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código de Calzado</th>
                <th>Cantidad</th>
                <th>Costo Unitario</th>
            </tr>
        </thead>
        <tbody>
            @if ($registros->isEmpty())
                <tr>
                    <td colspan="3">No hay registros de compra disponibles.</td>
                </tr>
            @else
                @foreach ($registros as $registro)
                    <tr>
                        <td>{{ $registro->cod_calzado ?? 'No disponible' }}</td>
                        <td>{{ $registro->cantidad ?? 'No disponible' }}</td>
                        <td>{{ $registro->costo_unitario ?? 'No disponible' }}</td>
                    </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>

    <a href="{{ route('admin.compra.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>

    
@endsection