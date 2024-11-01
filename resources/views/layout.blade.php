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

<body>
    <nav class="full-header-nav">
        <img src="{{ asset('images/nube.webp') }}" alt="Encabezado de Nube" class="header-image">
        <h1 class="header-title">
            <a href="{{ route('inicio') }}" class="text-white fw-bold">TIENDA NUBE</a>
        </h1>

        @guest
        @if (Route::has('login'))
            <div class="top-right-link d-flex justify-content-end align-items-center gap-2">
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-4 rounded-pill">
                {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-4 rounded-pill">
                {{ __('Register') }}
                </a>
            </div>
        @endif

        @else
        @if(Auth::user()->can('admin.inicio')) <!-- Verificación del permiso -->
            <!-- Contenedor para los botones desplegables en fila -->
            <div class="d-flex flex-column" style="position: absolute; top: 10px; left: 10px;">
                <div class="dropdown mb-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestionar Compra
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('admin.compra.create') }}">Agregar Lote</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.compra.index') }}">Lista Lote</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.pais.index') }}">Gestionar Pais</a></li>
                    </ul>
                </div>
            
                <div class="dropdown mb-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestionar Inventario
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="{{ route('admin.calzado.create') }}">Agregar Calzado</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.calzado.index') }}">Listar Calzado</a></li>
                    </ul>
                </div>
            
                <div class="dropdown mb-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestionar Venta
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                        <li><a class="dropdown-item" href="{{ route('admin.venta.create') }}">Agregar Nota Venta</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.venta.index') }}">Lista Nota Venta</a></li>
                        <li><a class="dropdown-item" href="#">Gestionar Descuento</a></li>
                    </ul>
                </div>
            
                <div class="dropdown mb-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestionar Usuario
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <li><a class="dropdown-item" href="{{ route('admin.cliente.create') }}">Agregar Cliente</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.cliente.index') }}">Lista Cliente</a></li>
                    </ul>
                </div>
            
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestionar Categorías
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                        <li><a class="dropdown-item" href="{{ route('admin.marca.index') }}">Gestionar Marca</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.modelo.index') }}">Gestionar Modelo</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.material.index') }}">Gestionar Material</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.talla.index') }}">Gestionar Talla</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.color.index') }}">Gestionar Color</a></li>
                    </ul>
                </div>
            </div>
        @endif

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
                            <button type="submit" class="dropdown-item">{{ __('Perfil') }}</button>
                        </form>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </nav>

    <div class="content" style="margin-top: 50px;"> <!-- Ajusta el margen superior según sea necesario -->
        @yield('contenido')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
