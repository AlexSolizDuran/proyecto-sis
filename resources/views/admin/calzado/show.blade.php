@extends('layout')

@section('contenido')
<div class="container my-5">
    <h1 class="text-center mb-4 display-4 text-primary">Detalles del Calzado</h1>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center py-4 rounded-top">
            <h3 class="mb-0 fs-3">Información del Producto</h3>
        </div>

        <div class="card-body p-5">
            <div class="row">
                <!-- Imagen del calzado -->
                <div class="col-md-6 mb-4 text-center">
                    <img src="{{ asset('storage/'.$calzado->imagen) }}" alt="Imagen del Calzado" class="img-fluid rounded-3 shadow-lg">
                </div>

                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-upc-scan"></i> <strong>Código:</strong> {{ $calzado->cod }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-gender-ambiguous"></i> <strong>Género:</strong> {{ $calzado->getGeneroCompleto() }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-cash"></i> <strong>Precio:</strong> ${{ $calzado->precio_venta}} USD</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-cash"></i> <strong>Costo PP:</strong> ${{ $calzado->costoPP }} USD</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-stack"></i> <strong>Cantidad de Pares:</strong> {{ $calzado->cantidad_pares }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-box-seam"></i> <strong>Modelo:</strong> {{ $calzado->modelo->nombre }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-rulers"></i> <strong>Talla:</strong> {{ $calzado->talla->numero }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Material:</strong> {{ $calzado->material->nombre }}</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    {{-- Botón para volver a la lista de calzados --}}
    <div class="text-center mt-5">
        <a href="{{ route('admin.calzado.index') }}" class="btn btn-outline-primary btn-lg px-4 py-2 rounded-pill">Volver a la lista</a>
    </div>
</div>

@endsection
