<!DOCTYPE html>
<html lang="es">
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
        <div class="top-right-link d-flex justify-content-end align-items-center gap-3">
            <a href="{{ route('login') }}" >{{ __('Login') }}</a>
            <a href="{{ route('register') }}" >{{ __('Register') }}</a>
        </div>
    @endif
    @else
    <div class="dropdown" style="position: absolute; top: 10px; right: 10px;">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="adminDropdown">
            <li>
                @can('admin.inicio')
                <a class="dropdown-item" href="{{ route('admin.inicio') }}">Ir al Inicio de Admin</a>
                <a class="dropdown-item" href="{{ route('admin.bitacora.index') }}">Bitacora</a>

                @endcan
            </li>
            <li>
                <form action="{{ route('cliente.cuenta.show', Auth::user()->ci) }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item">{{ __('Perfil')}} </button>
                </form>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item">{{ __('Logout')}} </button>
                </form>
            </li>
        </ul>
    </div>
    @endguest
</nav>


<body>
    
    <div>
        @yield('contenido')
    </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>