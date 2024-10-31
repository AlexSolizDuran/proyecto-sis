@extends('layout')

@section('contenido')

<div class="container mt-5">
    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Volver</a>
    <h1 class="text-center mb-4">Bitacora</h1>
        
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Codigo</th>
                    <th>CI</th>
                    <th>IP</th>
                    <th>Accion</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bitacoras as $bitacora)
                <tr>
                    <td>{{ $bitacora->id }}</td>
                    <td>{{ $bitacora->ci ?? 'No Registrado'  }}</td>
                    <td>{{ $bitacora->ip }}</td>
                    <td>{{ $bitacora->accion }}</td>
                    <td>{{ $bitacora->fecha }}</td>
                    <td>{{ $bitacora->hora }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection