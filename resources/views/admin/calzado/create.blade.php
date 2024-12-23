@extends('layout')
@section('contenido')

<div class="container">
    <a href="{{ route('admin.calzado.index')}}" class="btn btn-warning flex-fill me-1">Lista de Calzados</a>

    <h1>Crear Calzado</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.calzado.store') }}" method="POST" enctype="multipart/form-data" class="formulario">
        @csrf
        
        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select" id="genero" name="genero" required>
                <option value="">Seleccione un género</option>
                <option value="m">Masculino</option>
                <option value="f">Femenino</option>
                <option value="u">Unisex</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cod_marca" class="form-label">Marca</label>
            <select class="form-select" id="cod_marca" name="cod_marca" required>
                <option value="">Seleccione una marca</option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->cod }}">{{ $marca->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="cod_modelo" class="form-label">Modelo</label>
            <select class="form-select" id="cod_modelo" name="cod_modelo" required disabled>
                <option value="">Seleccione un modelo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cod_talla" class="form-label">Talla</label>
            <select class="form-select" id="cod_talla" name="cod_talla" required>
                <option value="">Seleccione una talla</option>
                @foreach ($tallas as $talla)
                    <option value="{{ $talla->cod }}">{{ $talla->numero }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cod_material" class="form-label">Material</label>
            <select class="form-select" id="cod_material" name="cod_material" required>
                <option value="">Seleccione un material</option>
                @foreach ($materiales as $material)
                    <option value="{{ $material->cod }}">{{ $material->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="cod_color" class="form-label">Color</label>
            <div id="custom-select" class="custom-select">
                <div id="select-display" class="select-display">Seleccione un color</div>
                <div id="options" class="options">
                    @foreach ($colores as $color)
                        <div class="option" data-value="{{ $color->cod }}" data-hex="{{ $color->codigo_color }}">
                            {{ $color->nombre }}
                            <span class="color-box" style="background-color: {{ $color->codigo_color }};"></span>
                        </div>
                    @endforeach
                </div>
                <div id="selected-colors" class="selected-colors">
                    <!-- Aquí aparecerán los colores seleccionados -->
                </div>
                <input type="hidden" name="selected_colors" id="selected_colors" value="">

                <div class="form-group">
                    <label for="imagen">Imagen del Calzado</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Crear Calzado</button>
    </form>
</div>

@endsection