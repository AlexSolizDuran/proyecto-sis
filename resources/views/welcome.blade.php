@extends('layout')

@section('contenido')
<div class="container mt-4 d-flex justify-content-center">
    <a href="{{ route('cliente.index') }}" class="btn btn-primary btn-lg" style="inline-size: 200px;">
        <i class="fas fa-shoe-prints"></i> Ver Calzados
    </a>
</div>

@endsection