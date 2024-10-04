<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Calzados</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Si usas Bootstrap u otro CSS -->
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Lista de Calzados</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Género</th>
                <th>Precio por Unidad</th>
                <th>Cantidad de Pares</th>
                <th>Código Lote</th>
                <th>Código Modelo</th>
                <th>Código Talla</th>
                <th>Código Material</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calzados as $calzado)
                <tr>
                    <td>{{ $calzado->cod }}</td>
                    <td>{{ $calzado->genero }}</td>
                    <td>{{ $calzado->precio_unidad }}</td>
                    <td>{{ $calzado->cantidad_pares }}</td>
                    <td>{{ $calzado->cod_lote }}</td>
                    <td>{{ $calzado->cod_modelo }}</td>
                    <td>{{ $calzado->cod_talla }}</td>
                    <td>{{ $calzado->cod_material }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a class="btn btn-primary">Agregar Nuevo Calzado</a>
</div>

<script src="{{ asset('js/app.js') }}"></script> <!-- Si usas Bootstrap u otro JS -->
</body>
</html>
