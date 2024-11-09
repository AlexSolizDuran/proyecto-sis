@extends('layout')

@section('contenido')
<div class="container my-5">
    <x-alert />

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center py-4 rounded-top">
            <h3 class="mb-0 fs-3">Información de {{ $calzado->modelo->marca->nombre }} {{ $calzado->modelo->nombre }}</h3>
        </div>

        <div class="card-body p-5">
            <div class="row">
                <!-- Espacio para la imagen -->
                <div class="col-md-4 mb-4 text-center">
                    <img src="{{ asset('storage/' . $calzado->imagen) }}" alt="Imagen del Calzado" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
                
                <!-- Información del calzado -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 mb-4 fs-5">
                            <p class="card-text"><i class="bi bi-gender-ambiguous"></i> <strong>Género:</strong> {{ $calzado->getGeneroCompleto() }}</p>
                        </div>
                        <div class="col-md-6 mb-4 fs-5">
                            <p class="card-text"><i class="bi bi-cash"></i> <strong>Precio:</strong> ${{ $calzado->precio_unidad }} USD</p>
                        </div>
                        <div class="col-md-6 mb-4 fs-5">
                            <p class="card-text"><i class="bi bi-rulers"></i> <strong>Talla:</strong> {{ $calzado->talla->numero }}</p>
                        </div>
                        <div class="col-md-6 mb-4 fs-5">
                            <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Material:</strong> {{ $calzado->material->nombre }}</p>
                        </div>
                    </div>
                </div>

                <!-- Formulario de compra -->
                <div class="col-12 mt-4 text-center">
                    @if ($calzado->cantidad_pares > 0)
                        <form action="{{ route('cliente.zapato.add') }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="cod" value="{{ $calzado->cod }}">
                            <label for="cantidad" class="me-2">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" min="1" max="{{ $calzado->cantidad_pares }}" value="1" style="width: 60px;" required>
                            <button type="submit" class="btn btn-primary ms-2">Comprar</button>
                        </form>
                    @else
                        <p class="text-danger fs-5"><strong>Producto agotado</strong></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para volver a la lista de calzados -->
    <div class="text-center mt-5">
        <a href="javascript:history.back()" class="btn btn-outline-primary btn-lg px-4 py-2 rounded-pill">Volver</a>
    </div>
</div>
@endsection
