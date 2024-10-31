@extends('layout')

@section('contenido')

<div class="container mt-5">
    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Volver</a>
    <h1 class="text-center mb-4">Lista de Modelos</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botón para abrir el modal de creación -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearModeloModal">Crear Nueva Modelo</button>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modelos as $modelo)
                <tr>
                    <td>{{ $modelo->cod }}</td>
                    <td>{{ $modelo->nombre }}</td>
                    <td>{{ $modelo->marca->nombre }}</td>
                    <td>
                        <!-- Botón para abrir el modal de edición -->
                        <button 
                            class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editarModeloModal" 
                            data-cod="{{ $modelo->cod }}" 
                            data-nombre="{{ $modelo->nombre }}" 
                            data-marca-id="{{ $modelo->marca->cod }}">
                            Editar
                        </button>
                        <!-- Formulario para eliminar el modelo -->
                        <form action="{{ route('admin.modelo.destroy', $modelo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este modelo?');">
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

<!-- Modal para Crear Modelo -->
<div class="modal fade" id="crearModeloModal" tabindex="-1" aria-labelledby="crearModeloModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearModeloModalLabel">Crear Modelo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crearModeloForm" method="POST" action="{{ route('admin.modelo.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="crear_modelo_nombre" class="form-label">Nombre del Modelo</label>
                        <input type="text" class="form-control" id="crear_modelo_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="crear_modelo_marca" class="form-label">Marca</label>
                        <select class="form-select" id="crear_modelo_marca" name="marca_cod" required>
                            <option value="">Selecciona una marca</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->cod }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Modelo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editarModeloModal" tabindex="-1" aria-labelledby="editarModeloModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModeloModalLabel">Editar Modelo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editarModeloForm" method="POST" action="{{ route('admin.modelo.update', ':cod') }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="editar_modelo_cod" name="cod">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editar_modelo_nombre" class="form-label">Nombre del Modelo</label>
                        <input type="text" class="form-control" id="editar_modelo_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editar_modelo_marca" class="form-label">Marca</label>
                        <select class="form-select" id="editar_modelo_marca" name="marca_cod" required>
                            <option value="">Selecciona una marca</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->cod }}" >
                                    {{ $marca->nombre }}
                                </option>
                            @endforeach
                        </select>
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