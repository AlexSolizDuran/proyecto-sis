@extends('layout')

@section('contenido')
@if(session()->has('carro') && count(session('carro', [])) > 0)
<div class="container">
    <div class="row">
        @php
            $precioTotal = 0;
        @endphp
        @foreach (session('carro', []) as $item)
            <!-- Aseguramos que en pantallas pequeñas ocupe toda la fila (col-12) y en pantallas medianas y mayores ocupe 6 columnas (col-md-6) -->
            <div class="col-12 col-md-6 col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-img-container" style="width: 100%; height: 250px; overflow: hidden;">
                        <img src="{{ asset('storage/'.$item['calzado']->imagen) }}" alt="Imagen del calzado" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3" style="font-size: 1.2rem; font-weight: bold;">
                            {{ $item['calzado']->modelo->marca->nombre }} {{ $item['calzado']->modelo->nombre }}
                        </h5>
                        <p class="card-text mb-2"><strong>Código:</strong> {{ $item['calzado']->cod }}</p>
                        <p class="card-text mb-2"><strong>Talla:</strong> {{ $item['calzado']->talla->numero }}</p>
                        <p class="card-text mb-2"><strong>Precio Unidad:</strong> ${{ number_format($item['calzado']->precio_unidad, 2) }}</p>
                        <p class="card-text mb-2"><strong>Cantidad:</strong> {{ $item['cantidad'] }}</p>
                        <p class="card-text"><strong>Total:</strong> ${{ number_format($item['calzado']->precio_unidad * $item['cantidad'], 2) }}</p>
                        <div class="d-flex justify-content-end mt-3">
                            <form action="{{ route('cliente.zapato.quitar', $item['calzado']->cod) }}" method="POST" class="me-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $precioTotal += $item['calzado']->precio_unidad * $item['cantidad'];
            @endphp
        @endforeach
    </div>

    <div class="d-flex justify-content-between align-items-center my-4">
        <h4><strong>Precio Total: ${{ number_format($precioTotal, 2) }}</strong></h4>
    </div>

    <div class="d-flex justify-content-center">
        <form action="{{ route('cliente.zapato.cancelar') }}" method="POST" class="me-2">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg px-4 py-2">Cancelar carro</button>
        </form>
        <form action="" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-lg px-4 py-2">Enviar carro</button>
        </form>
    </div>
</div>

@else
    <p class="text-center">No hay calzados en el carro.</p>
@endif
    
@endsection
