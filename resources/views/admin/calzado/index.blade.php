@extends('layout')

@section('contenido')
    
<div class="container">
    <h1>Lista de Calzados</h1>

    <!-- Enlace para crear un nuevo calzado -->
    <a href="{{ route('admin.calzado.create') }}" class="btn btn-success mb-3">Crear Nuevo Calzado</a>

    <!-- Verificamos si existen calzados -->
    @if($calzados->isEmpty())
        <p>No hay calzados disponibles.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Género</th>
                    <th>Precio Unidad</th>
                    <th>Cantidad Pares</th>
                    <th>Modelo</th>
                    <th>Material</th>
                    <th>Talla</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($calzados as $calzado)
                    <tr>
                        <td>{{ $calzado->cod }}</td>
                        <td>{{ $calzado->genero_completo }}</td>
                        <td>{{ $calzado->precio_unidad }}</td>
                        <td>{{ $calzado->cantidad_pares }}</td>
                        <td>{{ $calzado->modelo->nombre }}</td> <!-- Asumiendo relación con Modelo -->
                        <td>{{ $calzado->material->nombre }}</td> <!-- Asumiendo relación con Material -->
                        <td>{{ $calzado->talla->numero }}</td> <!-- Asumiendo relación con Talla -->
                        <td>
                            <!-- Botón para ver los detalles de un calzado -->
                            <a href="{{ route('admin.calzado.show', $calzado) }}" class="btn btn-info btn-sm">Ver</a>

                            <!-- Botón para editar un calzado -->
                            <a href="{{ route('admin.calzado.edit', $calzado) }}" class="btn btn-primary btn-sm">Editar</a>

                            <!-- Botón para eliminar un calzado -->
                            <form action="{{ route('admin.calzado.destroy', $calzado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este calzado?');">
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
