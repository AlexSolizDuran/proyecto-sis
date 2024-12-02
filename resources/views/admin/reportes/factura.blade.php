<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .header p {
            margin: 5px 0;
            font-size: 0.9em;
            color: #555;
        }

        .details {
            margin-top: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .details div {
            margin-bottom: 10px;
        }

        .details span {
            font-weight: bold;
        }

        .items {
            margin-top: 20px;
        }

        .items table {
            width: 100%;
            border-collapse: collapse;
        }

        .items th, .items td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }

        .items th {
            background-color: #f4f4f4;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }

        .total span {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h1>Nota de Venta</h1>
            <p>Tienda NUBE - NIT : 123456789</p>
            <p>Dirección: Ramada Av. Grigota 2do Anillo </p>
            <p>Teléfono: {{ $venta->administrador->persona->cel}} </p>
        </div>


        <div class="details">
            <div><span>Nota de Venta #:</span> {{ $venta->nro}}</div>
            <div><span>Fecha:</span> {{ $venta->fecha}}</div>
            <div><span>Cliente:</span> {{ $venta->cliente->persona->nombre}} {{ $venta->cliente->persona->apellido}}</div>
            <div><span>C.I. :</span> {{ $venta->ci_cliente}}</div>
            <div><span>Dirección:</span> {{ $venta->cliente->persona->direccion}}</div>
        </div>

        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Talla</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Descuento</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->registroventa as $item)
                    <tr>
                        <td>{{$item->calzado->modelo->marca->nombre}}</td>
                        <td>{{$item->calzado->modelo->nombre}}</td>
                        <td>{{$item->calzado->talla->numero}}</td>
                        <td>{{$item->cantidad}}</td>
                        <td>{{$item->precio_venta}} Bs</td>
                        <td>{{$item->descuento}} Bs</td>
                        <td>{{ ($item->cantidad * $item->precio_venta ) - ($item->descuento * $item->cantidad )}} Bs</td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>

        <div class="total">
            <p>Monto Total: <span>{{ $venta->monto_total}} Bs</span></p>
            <p>Descuento Total: <span>{{ $venta->descuento_total}} Bs</span></p>
            <p>Monto a Cobrar: <span>{{ $venta->monto_total - $venta->descuento_total }} Bs</span></p>
        </div>
    </div>
</body>
</html>
