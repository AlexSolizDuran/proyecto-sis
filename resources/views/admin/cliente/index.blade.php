@extends('layout')

@section('contenido')

<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Clientes</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    <a href="{{ route('admin.cliente.create') }}" class="btn btn-success mb-3">Crear Nuevo Cliente</a>


    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->ci_persona }}</td>
                    <td>{{ $cliente->persona->nombre }}</td>
                    <td>{{ $cliente->persona->apellido }}</td>
                    <td>{{ $cliente->persona->cel }}</td>

                    <td>
                        <a href="{{ route('admin.venta.create', $cliente) }}" class="btn btn-info btn-sm">Realizar venta</a>

                        <!-- Botón para ver los detalles de un calzado -->
                        <a href="{{ route('admin.cliente.show', $cliente) }}" class="btn btn-info btn-sm">Ver</a>

                        <!-- Botón para editar un calzado -->
                        <a href="{{ route('admin.cliente.edit', $cliente) }}" class="btn btn-primary btn-sm">Editar</a>

                        <!-- Botón para eliminar un calzado -->
                        <form action="{{ route('admin.cliente.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection