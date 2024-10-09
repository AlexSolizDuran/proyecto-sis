@extends('layout')

@section('contenido')
    
<div class="container">
    <h1>Lista de Nota de compras</h1>

    <!-- Enlace para crear un nuevo compra -->
    <a href="{{ route('admin.compra.create') }}" class="btn btn-success mb-3">Crear Nuevo compra</a>

    <!-- Verificamos si existen compras -->
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
                            <!-- Botón para ver los detalles de un compra -->
                            <a href="{{ route('admin.compra.show', $compra) }}" class="btn btn-info btn-sm">Ver</a>

                            <!-- Botón para editar un compra -->
                            <a href="{{ route('admin.compra.edit', $compra) }}" class="btn btn-primary btn-sm">Editar</a>

                            <!-- Botón para eliminar un compra -->
                            <form action="{{ route('admin.compra.destroy', $compra) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta compra?');">
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