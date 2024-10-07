<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NUBE</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<nav class="full-header-nav">
    
    <h1 class="header-title">  
        <a href="{{route('welcome')}}"> TIENDA NUBE </a> 
    </h1>
    <img src="{{ asset('images/nube.webp') }}" alt="Encabezado de Nube" class="header-image">
    
    <h1 class="top-right-link">
        <a href='{{route('admin.inicio')}}'  >ADMIN</a>
    </h1>
    
    
    
</nav>

<body>
    
    <div>
        @yield('contenido')
    </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>