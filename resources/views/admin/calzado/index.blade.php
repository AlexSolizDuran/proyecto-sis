@extends('layout')

@section('contenido')
    
<div class="container">
    <h1>Lista de Calzados</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

    <a href="{{ route('admin.calzado.create') }}" class="btn btn-success mb-3">Crear Nuevo Calzado</a>

    <form action="{{ route('admin.calzado.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="cod_marca" class="form-label">Marca</label>
                <select class="form-select" id="cod_marca" name="cod_marca">
                    <option value="">Seleccione una Marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->cod }}" {{ request('cod_marca') == $marca->cod ? 'selected' : '' }}>
                            {{ $marca->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="cod_modelo" class="form-label">Modelo</label>
                <select class="form-select" id="cod_modelo" name="cod_modelo">
                    <option value="">Seleccione un modelo</option>
                    @foreach ($modelos as $modelo)
                        <option value="{{ $modelo->cod }}" {{ request('cod_modelo') == $modelo->cod ? 'selected' : '' }}>
                            {{ $modelo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="cod_material" class="form-label">Material</label>
                <select class="form-select" id="cod_material" name="cod_material">
                    <option value="">Seleccione un material</option>
                    @foreach ($materiales as $material)
                        <option value="{{ $material->cod }}" {{ request('cod_material') == $material->cod ? 'selected' : '' }}>
                            {{ $material->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="cod_talla" class="form-label">Talla</label>
                <select class="form-select" id="cod_talla" name="cod_talla">
                    <option value="">Seleccione una talla</option>
                    @foreach ($tallas as $talla)
                        <option value="{{ $talla->cod }}" {{ request('cod_talla') == $talla->cod ? 'selected' : '' }}>
                            {{ $talla->numero }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <!-- Verificamos si existen calzados -->
    @if($calzados->isEmpty())
        <p>No hay calzados disponibles.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Marca</th>
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
                        <td>{{ $calzado->modelo->marca->nombre }}</td>
                        <td>{{ $calzado->genero_completo }}</td>
                        <td>{{ $calzado->precio_unidad }} Bs</td>
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
