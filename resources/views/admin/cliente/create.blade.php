@extends('layout')
@section('contenido')

<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1>Crear Cliente</h1>

    <form action="{{ route('admin.cliente.store') }}" method="POST" class="formulario">
        @csrf
        
        <div class="mb-3">
            <label for="ci" class="form-label">Carnet de Identidad</label>
            <input type="number" class="form-control no-arrows" id="ci" name="ci" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombres </label>
            <input type="text"  pattern="[A-Za-zñÑÀ-ÿ\s]+"  class="form_control" id="nombre" name="nombre" required onkeypress="return soloLetras(event)">
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text"  pattern="[A-Za-zñÑÀ-ÿ\s]+"  class="form-control" id="apellido" name="apellido" required onkeypress="return soloLetras(event)">
        </div>

        <div class="mb-3">
            <label for="cel" class="form-label">Telefono</label>
            <input type="number" class="form-control no-arrows" id="cel" name="cel" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-control " id="direccion" name="direccion" required>
        </div>

        <div class="mb-3">
            <label for="gmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="email"name="email"required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Cliente</button>
    </form>
</div>   
@endsection