@extends('layout')

@section('contenido')
<div class="container">
    <h2>Cambiar Contraseña</h2>
    <form action="{{ route('password.change') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nueva_password" class="form-label">Contraseña Actual</label>
            <input type="password" class="form-control" id="nueva_password" name="nueva_password" required>
            @error('nueva_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
    </form>
</div>
@endsection
