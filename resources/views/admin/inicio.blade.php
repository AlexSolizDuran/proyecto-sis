@extends('layout')

@section('contenido')
<div class="container mt-4">
    <div class="mb-4">
        <h2>Administrar Mercaderia</h2>
        <div class="btn-group">
            <a href="{{ route('admin.calzado.create') }}" class="btn btn-primary">Crear Calzado</a>
            <a href="{{ route('admin.lote_mercaderia.create') }}" class="btn btn-success">Crear Lote de Mercadería</a>
            <a href="{{ route('admin.calzado.index')}}" class="btn btn-warning">Lista de Calzados</a>
        </div>
    </div> 
    <div class="mb-4">   
        <h2>Administrar Cliente</h2>
        <div class = "btn-group">
            <a href="{{ route('admin.cliente.create')}}"class="btn btn-primary"> Crear Cliente</a>
            <a href="{{ route('admin.cliente.index')}}" class="btn btn-warning">Lista de Clientes</a>
        </div>
    </div>
    <div class="mb-4">
        <h2>Administrar Venta</h2>
        <div class="btn-group">
            <a href="{{ route('admin.venta.create')}}" class="btn btn-info"> Realizar venta</a>
            <a href="{{ route('admin.venta.index')}}" class="btn btn-warning"> Lista de Ventas</a>

        </div>
    </div>
</div>
@endsection