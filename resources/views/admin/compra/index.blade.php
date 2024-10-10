@extends('layout')

@section('contenido')
    
<div class="container">
    <h1>Lista de Lote de Mercaderia</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    <a href="{{ route('admin.compra.create') }}" class="btn btn-success mb-3">Registrar Nuevo Lote</a>

    @if($compras->isEmpty())
        <p>No hay compras disponibles.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numero de compra</th>
                    <th>fecha</th>
                    <th>Cantidad </th>
                    <th>Marca</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <td>{{ $compra->cod }}</td>
                        <td>{{ $compra->fecha_compra }}</td>
                        <td>{{ $compra->cantidad_total_pares }}</td>
                        <td>{{ $compra->marca->nombre }}</td> 
                        
                        <td>
                            <a href="{{ route('admin.compra.show', $compra) }}" class="btn btn-info btn-sm">Ver</a>
                            <form action="{{ route('admin.compra.destroy', $compra) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este Lote?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection