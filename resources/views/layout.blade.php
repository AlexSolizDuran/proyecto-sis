<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NUBE</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<nav>
    <a href="{{route('welcome')}}"> TIENDA NUBE</a>
</nav>
<body>
    
    <div>
        @yield('contenido')
    </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>