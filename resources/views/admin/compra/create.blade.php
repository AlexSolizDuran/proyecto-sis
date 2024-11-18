@extends('layout')

@section('contenido')

<div class="container mt-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1 class="text-center">Registrar Lote</h1>
    @if(!session()->has('lote'))
        <form action="{{ route('admin.compra.lote') }}" method="POST" class="mb-4" >
            @csrf
            <div class="mb-3">
                <label for="pais" class="form-label">Pais</label>
                <select class="form-select" id="pais" name="pais" required>
                    <option value="">Selecciona un pais</option>
                    @foreach ($paises as $pais)
                        <option value="{{ $pais->cod }}">{{ $pais->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-select" id="marca" name="marca" required>
                    <option value="">Selecciona un marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->cod }}">{{ $marca->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nit" class="form-label">NIT</label>
                <input type="number" class="form-control" id="nit" name="nit" required>
            </div>
            <div class="mb-3">
                <label for="proveedor" class="form-label">Nombre del Proveedor</label>
                <input type="text" step="0.01" class="form-control" id="proveedor" name="proveedor" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_total" class="form-label">Cantidad total</label>
                <input type="number" step="0.01" class="form-control" id="cantidad_total" name="cantidad_total" required>
            </div>
            <div class="mb-3">
                <label for="impuestos" class="form-label">Impuesto</label>
                <input type="number" step="0.01" class="form-control" id="impuestos" name="impuestos" required>
            </div>
            <div class="mb-3">
                <label for="costo_compra" class="form-label">Costo de Compra</label>
                <input type="number" class="form-control" id="costo_compra" name="costo_compra" required>
            </div>
            <div class="mb-3">
                <label for="costo_logistica" class="form-label">costo de logistica</label>
                <input type="number" class="form-control" id="costo_logistica" name="costo_logistica" required>

            </div>
            <button type="submit" class="btn btn-primary">Siguiente</button>
        </form>
    @endif
    @if(session()->has('lote'))
        <h2 class="text-center">Informacion de lote {{ session('lote.pais.nombre') }} {{ session('lote.marca.nombre')}}  -- {{ session('lote')['nit'] }}</h2>
            <form action="{{ route('admin.compra.filtrar') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" name="cod_marca" value="{{ session('lote.marca') }}">
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
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearCalzadoModal">Crear Nueva Calzado</button>


    @if($calzados->isEmpty())
    <p>No hay calzados disponibles.</p>
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Género</th>
                <th>marca</th>
                <th>Cantidad Pares</th>
                <th>Modelo</th>
                <th>Material</th>
                <th>Talla</th>
                <th>añadir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calzados as $calzado)
                <tr>
                    <td>{{ $calzado->cod }}</td>
                    <td>{{ $calzado->getGeneroCompleto() }}</td>
                    <td>{{ $calzado->modelo->marca->nombre}}</td>
                    <td>{{ $calzado->cantidad_pares }}</td>
                    <td>{{ $calzado->modelo->nombre }}</td> <!-- Asumiendo relación con Modelo -->
                    <td>{{ $calzado->material->nombre }}</td> <!-- Asumiendo relación con Material -->
                    <td>{{ $calzado->talla->numero }}</td> <!-- Asumiendo relación con Talla -->
                    <td>
                        <form action="{{ route('admin.compra.addlote') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="cod" value="{{ $calzado->cod }}">
                            <input type="number" name="cantidad" min="1" value="1" style="inline-size: 60px;" required>
                            <button type="submit" class="btn btn-primary">Agregar Calzado</button>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

        <h3>Registro de Compra:</h3>
       @if(session()->has('compra') && count(session('compra', [])) > 0)
       <table class="table table-striped table-bordered mb-4">
        <thead>
            <tr>
                <th>Código</th>
                <th>Marca</th>
                <TH>Modelo</TH>
                <th>Talla</th>
                <th>Cantidad</th>
            </tr>
        </thead>
            <tbody>
                @foreach (session('compra', []) as $item)
                    <tr>
                    <td>{{ $item['calzado']->cod }}</td>
                    <td>{{ $item['calzado']->modelo->marca->nombre }}</td>
                    <td>{{ $item['calzado']->modelo->nombre }}</td>
                    <td>{{ $item['calzado']->talla->numero }}</td>
                    <td>{{ $item['cantidad'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No hay calzados en el Lote</p>
        @endif
        <div class="text-center mb-4">
            <form action="{{ route('admin.compra.cancelar') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Cancelar Lote</button>
            </form>
        </div>
        
        <div class="text-center">
            <form action="{{ route('admin.compra.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Enviar Lote</button>
            </form>
        </div>
    @endif
</div>

<div class="modal fade" id="crearCalzadoModal" tabindex="-1" aria-labelledby="crearCalzadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Modal más grande para mejor visualización -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearCalzadoModalLabel">Crear Nuevo Calzado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.calzado.store') }}" method="POST" class="formulario">
                @csrf
                <input type="hidden" name="from_modal" value="1"> <!-- Indica que es desde el modal -->
                
                <div class="modal-body"> <!-- Sección del cuerpo del modal -->
                    <div class="mb-3">
                        <label for="genero" class="form-label">Género</label>
                        <select class="form-select" id="genero" name="genero" required>
                            <option value="">Seleccione un género</option>
                            <option value="m">Masculino</option>
                            <option value="f">Femenino</option>
                            <option value="u">Unisex</option>
                        </select>
                    </div>
                    @if(session()->has('lote'))
                    <div class="mb-3">
                        <label for="cod_marca" class="form-label">Marca</label>
                        
                        <input type="text" class="form-control" id="cod_marca" name="cod_marca" value="{{ session()->get('lote')['marca']['nombre'] }}" readonly>
                        
                        <input type="hidden" name="marca_cod" value="{{ session()->get('lote')['marca']['cod'] }}">
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="cod_modelo" class="form-label">Modelo</label>
                        <select class="form-select" id="cod_modelo" name="cod_modelo" required >
                            <option value="">Seleccione un modelo</option>
                            @foreach ($modelos as $modelo)
                                <option value="{{ $modelo->cod }}">{{ $modelo->nombre }}</option>
                            @endforeach
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Calzado</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
