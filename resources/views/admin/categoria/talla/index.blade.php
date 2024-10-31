@extends('layout')

@section('contenido')

<div class="container mt-5">
    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Volver</a>
    <h1 class="text-center mb-4">Lista de Tallas</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    <!-- Botón que abre el modal -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearTallaModal">Crear Nueva Talla</button>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Codigo</th>
                    <th>Numero</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tallas as $talla)
                <tr>
                    <td>{{ $talla->cod}}</td>
                    <td>{{ $talla->numero }}</td>

                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarTallaModal" data-cod="{{ $talla->cod }}" data-numero="{{ $talla->numero }}">Editar</button>
                        <form action="{{ route('admin.talla.destroy', $talla) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta talla?');">
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

<!-- Modal para crear una nueva talla -->
<div class="modal fade" id="crearTallaModal" tabindex="-1" aria-labelledby="crearTallaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearTallaModalLabel">Crear Nueva Talla</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.talla.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número de Talla</label>
                        <input type="number" class="form-control" id="numero" name="numero" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Talla</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para editar una talla -->
<div class="modal fade" id="editarTallaModal" tabindex="-1" aria-labelledby="editarTallaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarTallaModalLabel">Editar Talla</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editarTallaForm" method="POST" action="{{ route('admin.talla.update', ':cod') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_numero" class="form-label">Número de Talla</label>
                        <input type="number" class="form-control" id="edit_numero" name="numero" required>
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