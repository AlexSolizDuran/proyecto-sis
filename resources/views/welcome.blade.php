@extends('layout')

@section('contenido')
<div class="container">
    <!-- Sección de calzados -->
    <h3 class="text-center mt-4 mb-3">CALZADOS</h3>
    <div class="calzado-slider d-flex overflow-auto py-4" style="white-space: nowrap; gap: 15px;">
        @foreach ($calzados as $calzado)
            <div class="calzado-item d-inline-block" style="flex-shrink: 0; width: 220px;">
                <a href="{{ route('cliente.zapato.show', $calzado->cod) }}" class="calzado-link">
                    <div class="card calzado-card" style="width: 100%; height: 320px;">
                        <div class="card-img-container" style="height: 100%; overflow: hidden;">
                            <img src="{{ asset('storage/' . $calzado->imagen) }}" alt="Imagen del Calzado" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                        <div class="card-body p-4" style="height: calc(100% - 200px); padding: 10px 12px;">
                            <h5 class="card-title" style="font-size: 16px; font-weight: bold; line-height: 1.3; margin-bottom: 5px;">{{ $calzado->modelo->marca->nombre }} {{ $calzado->modelo->nombre }}</h5>
                            <p class="card-text" style="font-size: 14px; margin-bottom: 0;">
                                <strong>Precio:</strong> {{ $calzado->precio_venta }} Bs
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    
    <!-- Sección de ofertas -->
    <h3 class="text-center mt-4 mb-3">OFERTAS</h3>
    <div class="calzado-slider d-flex overflow-auto py-4" style="white-space: nowrap; gap: 15px;">
        @foreach ($ofertas as $calzado)
            <div class="calzado-item d-inline-block" style="flex-shrink: 0; width: 220px;">
                <a href="{{ route('cliente.zapato.show', $calzado->cod) }}" class="calzado-link">
                    <div class="card calzado-card" style="width: 100%; height: 320px;">
                        <div class="card-img-container" style="height: 100%; overflow: hidden;">
                            <img src="{{ asset('storage/' . $calzado->imagen) }}" alt="Imagen del Calzado" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                        <div class="card-body p-4" style="height: calc(100% - 200px); padding: 10px 12px;">
                            <h5 class="card-title" style="font-size: 16px; font-weight: bold; line-height: 1.3; margin-bottom: 5px;">
                                {{ $calzado->modelo->marca->nombre }} {{ $calzado->modelo->nombre }}
                            </h5>
                            <p class="card-text" style="font-size: 14px; margin-bottom: 0; display: flex; flex-direction: column; gap: 5px;">
                                <strong style="text-decoration: line-through;">Precio: {{ $calzado->precio_venta }} Bs</strong>
                                <strong>Ahora: {{ $calzado->costo_unitario }} Bs</strong>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Botón para regresar al índice de calzados -->
    <div class="text-center mt-5">
        <a href="{{ route('cliente.zapato.index') }}" class="btn btn-outline-primary btn-lg px-4 py-2 rounded-pill">
            Ver todos los calzados
        </a>
        <a href="{{ route('zapato.pedido') }}" class="btn btn-outline-primary btn-lg px-4 py-2 rounded-pill">Carro</a>
    </div>
</div>
@endsection
