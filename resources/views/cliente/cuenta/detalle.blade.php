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
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Admin:</strong> {{ $venta->cod_admin }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Monto Total:</strong> {{ $venta->monto_total }} Bs</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Descuento Total:</strong> {{ $venta->descuento_total }} Bs</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Cantidad:</strong> {{ $venta->cantidad }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">    
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Total a Cobrar </strong> {{ $venta->monto_total - $venta->descuento_total }} Bs</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Estado de Venta:</strong> {{ $venta->getEstado() }}</p>
                    <hr>
                </div>
                <div class="col-md-6 mb-4 fs-5">
                    <p class="card-text"><i class="bi bi-circle-fill"></i> <strong>Tipo de Pago:</strong> {{ $venta->getPago() }}</p>
                    <hr>
                </div>

                {{-- Botón de Pagado debajo de la información --}}
                
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('admin.venta.factura', $venta->nro) }}" target="_blank" class="btn btn-warning btn-lg">factura</a>
                    </div>
                
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
    <h2 class="text-center mb-4">Registro de Ventas</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Código de Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Monto a cobrar</th>
                    <th>Comentario</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->registroventa as $registro)
                    <tr>
                        <td>{{ $registro->cod_calzado }}</td>
                        <td>{{ $registro->cantidad }}</td>  
                        <td>{{ $registro->precio_venta }}</td>
                        <td>{{ $registro->descuento }}</td>
                        <td>{{ ($registro->cantidad * $registro->precio_venta)- ($registro->cantidad * $registro->descuento) }}</td>  
                        <td>
                            @php
                            $comentarioExistente = \App\Models\Resena::where('nro_reg', $registro->cod)->first();
                            @endphp

                            @if (!$comentarioExistente)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal{{ $registro->cod }}">
                                Agregar Comentario
                            </button>
                            @else
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewCommentModal{{ $registro->cod }}">
                                Ver Comentario
                            </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($venta->tipo_pago == 'k')
    <div class="table-responsive">
        <h2 class="text-center mb-4">Cuotas</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Monto</th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->creditos as $credito)
                        <tr>
                            <td>{{ $credito->fecha }}</td>  
                            <td>{{ $credito->monto_c }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>

@foreach ($venta->registroventa as $registro)
    @php
    // Verificar si ya existe un comentario para este registro
    $comentarioExistente = \App\Models\Resena::where('nro_reg', $registro->cod)->first();
    @endphp

    <div class="modal fade" id="commentModal{{ $registro->cod }}" tabindex="-1" aria-labelledby="commentModalLabel{{ $registro->cod }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel{{ $registro->cod }}">Agregar Comentario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cliente.resena.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nro_reg" value="{{ $registro->cod }}">
                        <div class="mb-3">
                            <label for="estrella" class="form-label">Calificación (1 a 5 estrellas)</label>
                            <div class="d-flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="estrella" id="estrella{{ $i }}" value="{{ $i }}" required>
                                        <label class="form-check-label" for="estrella{{ $i }}">{{ $i }} &#9733;</label>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentario</label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Comentario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($comentarioExistente)
    <div class="modal fade" id="viewCommentModal{{ $registro->cod }}" tabindex="-1" aria-labelledby="viewCommentModalLabel{{ $registro->cod }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCommentModalLabel{{ $registro->cod }}">Comentario Existente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Comentario:</strong> {{ $comentarioExistente->comentario }}</p>
                    <p><strong>Calificación:</strong> {{ $comentarioExistente->estrella }} &#9733;</p>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach

@endsection
