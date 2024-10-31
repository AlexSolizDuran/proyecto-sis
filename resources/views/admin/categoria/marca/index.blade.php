@extends('layout')

@section('contenido')

<div class="container mt-5">
    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Volver</a>
    <h1 class="text-center mb-4">Lista de Marcas</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearMarcaModal">Crear Nueva Marca</button>


    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marcas as $marca)
                <tr>
                    <td>{{ $marca->cod}}</td>
                    <td>{{ $marca->nombre }}</td>

                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarMarcaModal" data-cod="{{ $marca->cod }}" data-nombre="{{ $marca->nombre }}">Editar</button>
                        <form action="{{ route('admin.marca.destroy', $marca) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
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

<!-- Modal para Crear Marca -->
<div class="modal fade" id="crearMarcaModal" tabindex="-1" aria-labelledby="crearMarcaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearMarcaModalLabel">Crear Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crearMarcaForm" method="POST" action="{{ route('admin.marca.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="crear_Marca_nombre" class="form-label">Nombre del Marca</label>
                        <input type="text" class="form-control" id="crear_Marca_nombre" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Marca</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para editar una Marca -->
<div class="modal fade" id="editarMarcaModal" tabindex="-1" aria-labelledby="editarMarcaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarMarcaModalLabel">Editar Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editarMarcaForm" method="POST" action="{{ route('admin.marca.update', ':cod') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre de Marca</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection