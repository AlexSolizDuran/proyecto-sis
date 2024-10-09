<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NUBE</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<nav class="full-header-nav">
    <div class="header-content">
        <h1 class="header-title">  
            <a href="{{ route('welcome') }}"> TIENDA NUBE </a> 
        </h1>
    </div>
    
    <img src="{{ asset('images/nube.webp') }}" alt="Encabezado de Nube" class="header-image">
    
    @guest
            @if (Route::has('login'))
            <h1 class="top-right-link">
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </h1>
            @endif

        @else
        <li class="nav-item dropdown" style="position: relative;">
            <form action="{{ route('logout') }}" method="POST" style="position: absolute; inset-block-start: 10px; inset-inline-start: 10px;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </li>
            <h1 class="top-right-link">
                <a href='{{ route('admin.inicio') }}'> ADMIN -- {{ Auth::user()->name }} -- {{ Auth::user()->cod }} </a>
            </h1>
        @endguest

</nav>


<body>
    
    <div>
        @yield('contenido')
    </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>