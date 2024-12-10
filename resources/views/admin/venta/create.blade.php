@extends('layout')

@section('contenido')

<div class="container mt-4">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <h1 class="text-center">Realizar Venta</h1>
    @if(!session()->has('ci_persona'))
        <form action="{{ route('admin.venta.buscarCliente') }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="number" name="ci_persona" class="form-control" placeholder="Ingrese su carnet" required>
                <button type="submit" class="btn btn-primary">Buscar Cliente</button>
            </div>
        </form>
    @endif
    @if(session()->has('ci_persona'))
        <h2 class="text-center">Cliente Encontrado: {{ session('persona')->nombre }} {{ session('persona')->apellido }}  -- {{ session('ci_persona') }}</h2>
            <form action="{{ route('admin.venta.filtrar') }}" method="GET" class="mb-4">
                <div class="row">
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

    @if($calzados->isEmpty())
    <p>No hay calzados disponibles.</p>
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Género</th>
                <th>Precio venta</th>
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
                    @if ($calzado->oferta())
                        <td class="text-success">{{ $calzado->costo_unitario }}bs</td>
                    @else
                        <td>{{ $calzado->precio_venta }}bs</td>
                    @endif
                    <td>{{ $calzado->cantidad_pares }}</td>
                    <td>{{ $calzado->modelo->nombre }}</td> <!-- Asumiendo relación con Modelo -->
                    <td>{{ $calzado->material->nombre }}</td> <!-- Asumiendo relación con Material -->
                    <td>{{ $calzado->talla->numero }}</td> <!-- Asumiendo relación con Talla -->
                    <td>
                        <form action="{{ route('admin.venta.addCalzado') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="cod" value="{{ $calzado->cod }}">
                            <input type="number" name="cantidad" 
                                   min="1" max="{{ $calzado->cantidad_pares }}" 
                                   value="1" style="inline-size: 60px;" 
                                   required onkeypress="return false;"> <!-- Prevents typing -->
                            <button type="submit" class="btn btn-primary" 
                                    {{ $calzado->cantidad_pares == 0 ? 'disabled' : '' }}>
                                Agregar Calzado
                            </button>
                        </form>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

        <h3>Calzados en el Carrito:</h3>
       @if(session()->has('carrito') && count(session('carrito', [])) > 0)
       <table class="table table-striped table-bordered mb-4">
        <thead>
            <tr>
                <th>Código</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
            <tbody>
                @php
                $precioTotal = 0; 
                @endphp
                @foreach (session('carrito', []) as $item)
                    <tr>
                    <td>{{ $item['calzado']->cod }}</td>
                    <td>{{ $item['calzado']->modelo->marca->nombre }}</td>
                    <td>{{ number_format($item['calzado']->precio_venta, 2) }}Bs</td>
                    <td> @if ($item['calzado']->oferta()) 
                        {{ number_format($item['calzado']->costo_unitario, 2) }}Bs 
                        @else 0 Bs @endif</td>
                    <td>{{ $item['cantidad'] }}</td>
                    <td> @if ($item['calzado']->oferta())
                            {{ number_format($item['calzado']->precio_venta * $item['cantidad'] - $item['calzado']->costo_unitario * $item['cantidad'], 2  ) }}
                        @else
                            {{ number_format($item['calzado']->precio_venta * $item['cantidad'] , 2  ) }}
                        @endif
                        </td>
                    <td>
                  
                        <!-- Botón de eliminar -->
                        <form action="{{ route('admin.venta.delCalzado', $item['calzado']->cod) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                    </tr>
                    @php
                    if ($item['calzado']->oferta()){
                        $precioTotal += ($item['calzado']->precio_venta * $item['cantidad']) -
                                    ($item['calzado']->costo_unitario * $item['cantidad']);
                    }else{
                        $precioTotal += ($item['calzado']->precio_venta * $item['cantidad']);
                    }
                    
                    @endphp
                @endforeach
            </tbody>
        </table>
        <h4><strong>Precio Total: ${{ number_format($precioTotal, 2) }}</strong></h4>
        @else
            <p>No hay calzados en el carrito.</p>
        @endif
        <div class="text-center mb-4">
            <form action="{{ route('admin.venta.cancelar') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Cancelar Carrito</button>
            </form>
        </div>
        
        <div class="text-center">

            <form action="{{ route('admin.venta.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="tipo_pago" class="form-label">Tipo</label>
                    <select class="form-select" id="tipo_pago" name="tipo_pago" required>
                        <option value="">Seleccione un Tipo de pago</option>
                        <option value="c">Contado</option>
                        <option value="k">Credito</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Carrito</button>
            </form>
        </div>
    @endif
</div>

@endsection
