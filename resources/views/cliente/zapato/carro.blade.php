@extends('layout')

@section('contenido')
@if(session()->has('carro') && count(session('carro', [])) > 0)
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-4 w-100">
            <thead class="thead-dark">
                <tr>
                    <th>Imagen</th> <!-- Nueva columna para la imagen -->
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Talla</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @php
                $precioTotal = 0; 
                @endphp
                @foreach (session('carro', []) as $item)
                <tr>
                    <td><img src="{{ asset('storage/'.$item['calzado']->imagen) }}" alt="Imagen del calzado" class="img-fluid" style="max-width: 100px; height: auto;"></td> <!-- Imagen del calzado -->
                    <td>{{ $item['calzado']->cod }}</td>
                    <td>{{ $item['calzado']->modelo->marca->nombre }}</td>
                    <td>{{ $item['calzado']->talla->numero }}</td>
                    <td>${{ number_format($item['calzado']->precio_unidad, 2) }}</td>
                    <td>{{ $item['cantidad'] }}</td>
                    <td>${{ number_format($item['calzado']->precio_unidad * $item['cantidad'], 2) }}</td>
                    <td>
                        <!-- Botón de eliminar -->
                        <form action="{{ route('cliente.zapato.quitar', $item['calzado']->cod) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @php
                $precioTotal += $item['calzado']->precio_unidad * $item['cantidad'];
                @endphp
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><strong>Precio Total: ${{ number_format($precioTotal, 2) }}</strong></h4>
        </div>
    </div>
</div>


@else
    <p class="text-center">No hay calzados en el carro.</p>
@endif

<div class="text-center mb-4">
    <form action="{{ route('cliente.zapato.cancelar') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-danger btn-lg px-4 py-2">Cancelar carro</button>
    </form>
</div>

<div class="text-center">
    <form action="" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success btn-lg px-4 py-2">Enviar carro</button>
    </form>
</div>


    
@endsection
