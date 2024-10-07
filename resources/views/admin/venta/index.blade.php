@extends('layout')

@section('contenido')
    
<div class="container">
    <h1>Lista de Nota de Ventas</h1>

    <!-- Enlace para crear un nuevo venta -->
    <a href="{{ route('admin.venta.create') }}" class="btn btn-success mb-3">Crear Nuevo venta</a>

    <!-- Verificamos si existen ventas -->
    @if($ventas->isEmpty())
        <p>No hay ventas disponibles.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numero de venta</th>
                    <th>fecha</th>
                    <th>Monto Total</th>
                    <th>Cantidad </th>
                    <th>Ci del Cliente</th>
                    <th>codigo del admin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->nro }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>{{ $venta->monto_total}}</td>
                        <td>{{ $venta->cantidad }}</td>
                        <td>{{ $venta->ci_cliente}}</td> 
                        <td>{{ $venta->cod_admin }}</td> 
                        
                        <td>
                            <!-- Botón para ver los detalles de un venta -->
                            <a href="{{ route('admin.venta.show', $venta) }}" class="btn btn-info btn-sm">Ver</a>

                            <!-- Botón para editar un venta -->
                            <a href="{{ route('admin.venta.edit', $venta) }}" class="btn btn-primary btn-sm">Editar</a>

                            <!-- Botón para eliminar un venta -->
                            <form action="{{ route('admin.venta.destroy', $venta) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este venta?');">
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