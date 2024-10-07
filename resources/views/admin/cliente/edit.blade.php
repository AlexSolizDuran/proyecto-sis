@extends('layout')

@section('contenido')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <h1>Editar Cliente</h1>

    <form action="{{ route('admin.cliente.update', $cliente) }}" method="POST" class="formulario">
        @csrf
        @method('PUT') <!-- Indica que es un método PUT para la actualización -->
        
        <div class="mb-3">
            <label for="ci_persona" class="form-label">Carnet de Identidad</label>
            <input type="number" class="form-control no-arrows" id="ci_persona" name="ci_persona" value="{{ $cliente->ci_persona }}" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombres </label>
            <input type="text"  pattern="[A-Za-zñÑÀ-ÿ\s]+"  class="form_control" id="nombre" name="nombre" value="{{ $cliente->persona->nombre}}" required >
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text"  pattern="[A-Za-zñÑÀ-ÿ\s]+"  class="form-control" id="apellido" name="apellido" value="{{ $cliente->persona->apellido}}" required >
        </div>

        <div class="mb-3">
            <label for="cel" class="form-label">Telefono</label>
            <input type="number" class="form-control no-arrows" id="cel" name="cel" value="{{ $cliente->persona->cel}}" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-control " id="direccion" name="direccion" value="{{ $cliente->direccion}}" required>
        </div>

        <div class="mb-3">
            <label for="gmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="gmail"name="gmail" value="{{ $cliente->gmail}}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </form>
</div>
@endsection