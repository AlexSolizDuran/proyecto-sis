@extends('layout')

@section('contenido')

<div class="container mt-5">
    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Volver</a>
    <h1 class="text-center mb-4">Lista de Colores</h1>
    {{-- Este componente muestra las alertas para mensajes de éxito y de error --}}    
    <x-alert />
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearColorModal">Crear Nueva Color</button>


    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colores as $color)
                <tr>
                    <td>{{ $color->cod}}</td>
                    <td>{{ $color->nombre }}</td>
                    <td>
                        <div style="inline-size: 30px; block-size: 30px; background-color: {{ $color->codigo_color }}; display: inline-block; border: 1px solid #000;"></div>
                        <!-- Aquí se muestra el cuadrado de color -->
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarColorModal" 
                                data-cod="{{ $color->cod }}" 
                                data-nombre="{{ $color->nombre }}"
                                data-codigo_color="{{ $color->codigo_color }}">Editar</button>
                                <form action="{{ route('admin.color.destroy', $color) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
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

<!-- Modal para crear un nuevo color -->
<div class="modal fade" id="crearColorModal" tabindex="-1" aria-labelledby="crearColorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearColorModalLabel">Crear Nuevo Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.color.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de Color</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo_color" class="form-label">Seleccione un Color</label>
                        <input type="color" class="form-control" id="codigo_color" name="codigo_color" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Color</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para editar un color -->
<div class="modal fade" id="editarColorModal" tabindex="-1" aria-labelledby="editarColorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarColorModalLabel">Editar Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editarColorForm" method="POST" action="{{ route('admin.color.update', ':cod') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre de Color</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo_color" class="form-label">Seleccione un Color</label>
                        <input type="color" id="codigo_color" name="codigo_color" required>
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