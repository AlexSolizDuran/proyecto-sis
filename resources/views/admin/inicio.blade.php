@extends('layout')

@section('contenido')
<div class="container mt-4">
    <li class="nav-item dropdown" style="position: relative;">
        <form action="{{ route('logout') }}" method="POST" style="position: absolute; inset-block-start: 10px; inset-inline-start: 10px;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </li>
    <h1 class="text-center mb-5" style="color: #4A90E2;">Administración </h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Administrar Calzados</h4>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.calzado.create') }}" class="btn btn-light">Crear Calzado</a>
                    <a href="{{ route('admin.calzado.index')}}" class="btn btn-warning">Lista de Calzados</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Administrar Clientes</h4>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.cliente.create')}}" class="btn btn-light">Crear Cliente</a>
                    <a href="{{ route('admin.cliente.index')}}" class="btn btn-warning">Lista de Clientes</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow border-info">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Administrar Ventas</h4>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.venta.create')}}" class="btn btn-light">Realizar Venta</a>
                    <a href="{{ route('admin.venta.index')}}" class="btn btn-warning">Lista de Ventas</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow border-info">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Administrar Compras</h4>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.compra.create')}}" class="btn btn-light">Registrar Compra</a>
                    <a href="{{ route('admin.compra.index')}}" class="btn btn-warning">Lista de Compras</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection