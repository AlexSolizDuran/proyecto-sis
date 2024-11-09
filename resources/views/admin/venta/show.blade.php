@extends('layout')

@section('contenido')
<div class="container my-5">
    <h1 class="text-center mb-4 display-4 text-primary">Detalles de la Venta</h1>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white text-center py-4 rounded-top">
            <h3 class="mb-0 fs-3">Información de la Venta</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i><strong>Número de Venta:</strong> {{ $venta->nro }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i><strong>Fecha:</strong> {{ $venta->fecha }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i><strong>Cliente:</strong> {{ $venta->ci_cliente }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Admin:</strong> {{ $venta->cod_admin }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Monto Total:</strong> ${{ $venta->monto_total }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Estado de Venta:</strong> {{ $venta->getEstado() }}</p>
                    <hr>
                </div>
                {{-- Botón de Pagado debajo de la información --}}
                @if ($venta->estado == '0')
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('venta.sinCancelar', $venta->nro) }}" class="btn btn-danger btn-lg">Sin Cancelar</a>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
    <h2 class="text-center mb-4">Registro de Ventas</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Código de Venta</th>
                    <th>Código de Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->registroventa as $registro)
                    <tr>
                        <td>{{ $registro->cod }}</td>
                        <td>{{ $registro->cod_calzado }}</td>
                        <td>{{ $registro->precio_venta }}</td>
                        <td>{{ $registro->cantidad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Enlace para volver a la lista de ventas --}}
    <a href="{{ route('admin.venta.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
@endsection
