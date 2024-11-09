@extends('layout')

@section('contenido')
    
<div class="container">
    <h1>Lista de Calzados</h1>

    <!-- Formulario de filtrado -->
    <form action="{{ route('cliente.zapato.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
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
            <div class="col-md-3">
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
            <div class="col-md-3">
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
            <div class="col-md-3">
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
    <div class="container">
        <div class="row">
            @foreach ($calzados as $calzado)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4"> <!-- Ajuste automático de columnas -->
                    <a href="{{ route('cliente.zapato.show', $calzado->cod) }}" class="calzado-link">
                        <div class="card calzado-card" style="height: 100%;">
                            <div class="card-img-container" style="height: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $calzado->imagen) }}" alt="Imagen del Calzado" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <div class="card-body" style="padding: 10px;">
                                <h5 class="card-title" style="font-size: 1rem; font-weight: bold; margin-bottom: 5px;">
                                    {{ $calzado->modelo->marca->nombre }} {{ $calzado->modelo->nombre }}
                                </h5>
                                <p class="card-text" style="font-size: 0.9rem; margin-bottom: 0;">
                                    <strong>Precio:</strong> ${{ $calzado->precio_unidad }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
