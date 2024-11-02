@extends('layout')

@section('contenido')

<div class="container mt-5">
    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Volver</a>
    <h1 class="text-center mb-4">Lista de Materiales</h1>
       {{-- Este componente muestra las alertas para mensajes de éxito y de error --}}    
        <x-alert />
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearMaterialModal">Crear Nuevo Material</button>


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
                @foreach ($materiales as $material)
                <tr>
                    <td>{{ $material->cod}}</td>
                    <td>{{ $material->nombre }}</td>

                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarMaterialModal" data-cod="{{ $material->cod }}" data-nombre="{{ $material->nombre }}">Editar</button>
                        <form action="{{ route('admin.material.destroy', $material) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este Material?');">
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
    
<!-- Modal para Crear material -->
<div class="modal fade" id="crearMaterialModal" tabindex="-1" aria-labelledby="crearmaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearMaterialModalLabel">Crear material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crearmaterialForm" method="POST" action="{{ route('admin.material.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="crear_material_nombre" class="form-label">Nombre del material</label>
                        <input type="text" class="form-control" id="crear_material_nombre" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear material</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para editar una material -->
<div class="modal fade" id="editarMaterialModal" tabindex="-1" aria-labelledby="editarMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarMaterialModalLabel">Editar material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editarMaterialForm" method="POST" action="{{ route('admin.material.update', ':cod') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre de material</label>
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