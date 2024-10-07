@extends('layout')

@section('contenido')
<div class="container">
    <h1>Lista de Calzados</h1>

    <!-- Mostrar la lista de calzados -->
    <div class="row">
        @foreach($calzados as $calzado)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $calzado->cod }}</h5>
                    <p class="card-text">Precio: ${{ $calzado->precio_unidad }}</p>
                    <button class="btn btn-primary add-to-cart" data-id="{{ $calzado->cod }}" data-nombre="{{ $calzado->cod }}" data-precio="{{ $calzado->precio_unidad }}">Agregar al carrito</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Carrito -->
    <div class="mt-4">
        <h2>Carrito de Compras</h2>
        <table class="table table-bordered" id="cart-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Aquí se insertarán los productos agregados al carrito -->
            </tbody>
        </table>
        <button id="send-cart" class="btn btn-success mt-3">Enviar Pedido</button>
    </div>
</div>
@endsection

