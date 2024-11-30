@extends('layout')

@section('contenido')
<style>
   
    #amount, #card-element {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 15px;
        transition: border-color 0.3s ease;
    }

    #amount:focus, #card-element:focus {
        border-color: #5b9bd5;
        outline: none;
    }

</style>


@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
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
                    <div class="card-img-container" style="inline-size: 100%; block-sizet: 250px; overflow: hidden;">
                        <img src="{{ asset('storage/'.$item['calzado']->imagen) }}" alt="Imagen del calzado" class="img-fluid" style="object-fit: cover; inline-size: 100%: 100%; block-size: 100%;">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3" style="font-size: 1.2rem; font-weight: bold;">
                            {{ $item['calzado']->modelo->marca->nombre }} {{ $item['calzado']->modelo->nombre }}
                        </h5>
                        <p class="card-text mb-2"><strong>Código:</strong> {{ $item['calzado']->cod }}</p>
                        <p class="card-text mb-2"><strong>Talla:</strong> {{ $item['calzado']->talla->numero }}</p>
                        <p class="card-text mb-2"><strong>Precio Unidad:</strong> ${{ number_format($item['calzado']->precio_venta, 2) }}</p>
                        <p class="card-text mb-2"><strong>Cantidad:</strong> {{ $item['cantidad'] }}</p>
                        <p class="card-text"><strong>Total:</strong> ${{ number_format($item['calzado']->precio_venta * $item['cantidad'], 2) }}</p>
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
                $precioTotal += $item['calzado']->precio_venta * $item['cantidad'];
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
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearclienteModal">Paypal</button>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#payment-form1">Stripe</button>

    </div>
</div>

@else
    <p class="text-center">No hay calzados en el carro.</p>
@endif
    
<div class="modal fade" id="crearclienteModal" tabindex="-1" aria-labelledby="crearclienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearclienteModalLabel">Pago por paypal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crearclienteForm" method="POST" action="{{ route('cliente.zapato.store') }}">
                @csrf
                <div class="modal-body">
                    <!-- Campo CI -->
                    <div class="mb-3">
                        <label for="crear_cliente_ci" class="form-label">CI</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="crear_cliente_ci" 
                            name="ci" 
                            value="{{ auth()->check() ? auth()->user()->ci : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Nombre -->
                    <div class="mb-3">
                        <label for="crear_cliente_nombre" class="form-label">Nombre</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="crear_cliente_nombre" 
                            name="nombre" 
                            value="{{ auth()->check() ? auth()->user()->nombre : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Apellido -->
                    <div class="mb-3">
                        <label for="crear_cliente_apellido" class="form-label">Apellido</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="crear_cliente_apellido" 
                            name="apellido" 
                            value="{{ auth()->check() ? auth()->user()->apellido : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Email -->
                    <div class="mb-3">
                        <label for="crear_cliente_email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="crear_cliente_email" 
                            name="email" 
                            value="{{ auth()->check() ? auth()->user()->email : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Dirección -->
                    <div class="mb-3">
                        <label for="crear_cliente_direccion" class="form-label">Dirección</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="crear_cliente_direccion" 
                            name="direccion" 
                            value="{{ auth()->check() ? auth()->user()->direccion : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Celular -->
                    <div class="mb-3">
                        <label for="crear_cliente_cel" class="form-label">Celular</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="crear_cliente_cel" 
                            name="cel" 
                            value="{{ auth()->check() ? auth()->user()->cel : '' }}" 
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">PAGAR</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
    

<div class="modal fade" id="payment-form1" tabindex="-1" aria-labelledby="crearclienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearclienteModalLabel">Pago por stripe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="payment-form" method="POST" action="{{ route('stripe.processPayment') }}">
                @csrf
                <div class="modal-body">
                    <!-- Campo CI -->
                    <div class="mb-3">
                        <label for="crear_cliente_ci" class="form-label">CI</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="crear_cliente_ci" 
                            name="ci" 
                            value="{{ auth()->check() ? auth()->user()->ci : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Nombre -->
                    <div class="mb-3">
                        <label for="crear_cliente_nombre" class="form-label">Nombre</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="crear_cliente_nombre" 
                            name="nombre" 
                            value="{{ auth()->check() ? auth()->user()->nombre : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Apellido -->
                    <div class="mb-3">
                        <label for="crear_cliente_apellido" class="form-label">Apellido</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="crear_cliente_apellido" 
                            name="apellido" 
                            value="{{ auth()->check() ? auth()->user()->apellido : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Email -->
                    <div class="mb-3">
                        <label for="crear_cliente_email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="crear_cliente_email" 
                            name="email" 
                            value="{{ auth()->check() ? auth()->user()->email : '' }}" 
                            required>
                    </div>
            
                    <!-- Campo Dirección -->
                    <div class="mb-3">
                        <label for="crear_cliente_direccion" class="form-label">Dirección</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="crear_cliente_direccion" 
                            name="direccion" 
                            value="{{ auth()->check() ? auth()->user()->direccion : '' }}" 
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="card-element">Información de la tarjeta:</label>
                    </div>
                    <div id="card-element">
                        <!-- Stripe Elements insertará un campo de tarjeta de crédito aquí -->
                    </div>
            
                    <!-- Campo Celular -->
                    <div class="mb-3">
                        <label for="crear_cliente_cel" class="form-label">Celular</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="crear_cliente_cel" 
                            name="cel" 
                            value="{{ auth()->check() ? auth()->user()->cel : '' }}" 
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">PAGAR</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
<script>
    const stripe = Stripe('{{ $stripeKey }}'); // Usar la clave pública pasada desde el backend
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': { color: '#a0aec0' },
            },
            invalid: { color: '#fa755a', iconColor: '#fa755a' },
        },
    });
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const {token, error} = await stripe.createToken(cardElement);
        if (error) {
            console.error(error);
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script>

@endsection
