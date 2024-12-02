<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Venta de Edad - Genero</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 0px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }

        .date-range {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: #ffffff;
        }
        td {
            background-color: #f2f2f2;
        }

        .summary {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .summary div {
            margin-bottom: 5px;
        }

        .total-label {
            font-size: 18px;
            color: #333;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="title">Reporte de Venta de {{$edad}} - Masculino</h2>
        <table>
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($masculino as $item)
                    <tr>
                        <td>{{ $item->numero }}</td>
                        <td>{{ $item->cantidad }}</td>
                    </tr>
                @endforeach
            </tbody>
            <div class="summary">
                <div>Total Cantidad: {{ $totalm}} </div>
            </div>
    </div>
    <div class="container">
        <h2 class="title">Reporte de Venta de {{$edad}} - Femenino</h2>
        <table>
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($femenino as $item)
                    <tr>
                        <td>{{ $item->numero }}</td>
                        <td>{{ $item->cantidad }}</td>
                    </tr>
                @endforeach
            </tbody>
            <div class="summary">
                <div>Total Cantidad: {{ $totalf}} </div>
            </div>
    </div>
    <div class="container">
            <h2 class="title">Reporte de Venta de {{$edad}} - Unisex</h2>
            <table>
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unisex as $item)
                        <tr>
                            <td>{{ $item->numero }}</td>
                            <td>{{ $item->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="summary">
                    <div>Total Cantidad: {{ $totalu}} </div>
                </div>
    </div>
</body>
</html>