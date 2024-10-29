@extends('layout')

@section('contenido')

<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Paises</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearPaisModal">Añadir Pais</button>


    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Horma</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paises as $pais)
                <tr>
                    <td>{{ $pais->cod}}</td>
                    <td>{{ $pais->nombre }}</td>
                    <td>{{ $pais->horma }}</td>

                    <td>
                        <button class="btn btn-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editarPaisModal" 
                                data-cod="{{ $pais->cod }}" 
                                data-nombre="{{ $pais->nombre }}"
                                data-horma="{{ $pais->horma}}">Editar</button>
                        <form action="{{ route('admin.pais.destroy', $pais->cod) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este pais?');">
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
    
<!-- Modal para Crear pais -->
<div class="modal fade" id="crearPaisModal" tabindex="-1" aria-labelledby="crearPaisModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearPaisModalLabel">Crear Pais</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crearPaisForm" method="POST" action="{{ route('admin.pais.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="crear_pais_cod" class="form-label">Codigo</label>
                        <input type="text" maxlength="5" class="form-control" id="crear_pais_cod" name="cod" required>
                    </div>
                    <div class="mb-3">
                        <label for="crear_pais_horma" class="form-label">Horma</label>
                        <input type="text" maxlength="1" class="form-control" id="crear_pais_horma" name="horma" required>
                    </div>
                    <div class="mb-3">
                        <label for="crear_pais_nombre" class="form-label">Nombre del pais</label>
                        <input type="text" class="form-control" id="crear_pais_nombre" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear pais</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para editar una pais -->
<div class="modal fade" id="editarPaisModal" tabindex="-1" aria-labelledby="editarPaisModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPaisModalLabel">Editar pais</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editarPaisForm" method="POST" action="{{ route('admin.pais.update', ':cod') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_cod" class="form-label">Codigo</label>
                        <input type="text" class="form-control" id="edit_cod" name="cod" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_horma" class="form-label">Horma</label>
                        <input type="text" maxlength="1" class="form-control" id="edit_horma" name="horma" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre del Pais</label>
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