@extends('layout')

@section('contenido')
<div class="container mt-4">
    
    <h1 class="text-center mb-5" style="color: #4A90E2;">Administración </h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Administrar Calzados</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.calzado.create') }}" class="btn btn-light flex-fill me-1">Crear Calzado</a>
                        <a href="{{ route('admin.calzado.index')}}" class="btn btn-warning flex-fill me-1">Lista de Calzados</a>
                        
                        <!-- Dropdown para las categorías -->
                        <div class="dropdown flex-fill">
                            <button class="btn btn-warning dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorías
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('admin.marca.index') }}">Marca</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.modelo.index') }}">Modelo</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.material.index') }}">Material</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.color.index') }}">Color</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.talla.index') }}">Talla</a></li>
                            </ul>
                        </div>
                    </div>
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