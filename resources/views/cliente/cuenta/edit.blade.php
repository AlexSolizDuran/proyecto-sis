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
    <h1>Editar </h1>

    <form action="{{ route('cliente.cuenta.update', $persona->ci) }}" method="POST" class="formulario">
        @csrf
        @method('PUT') <!-- Indica que es un método PUT para la actualización -->
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombres </label>
            <input type="text"  pattern="[A-Za-zñÑÀ-ÿ\s]+"  class="form_control" id="nombre" name="nombre" value="{{ $persona->nombre}}" required >
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text"  pattern="[A-Za-zñÑÀ-ÿ\s]+"  class="form-control" id="apellido" name="apellido" value="{{ $persona->apellido}}" required >
        </div>

        <div class="mb-3">
            <label for="cel" class="form-label">Telefono</label>
            <input type="number" class="form-control no-arrows" id="cel" name="cel" value="{{ $persona->cel}}" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-control " id="direccion" name="direccion" value="{{ $persona->direccion}}" required>
        </div>
        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection