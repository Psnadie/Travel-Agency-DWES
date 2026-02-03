<!doctype html>
<html lang="es">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Venta de Vacaciones')</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/styles.css?r=' . rand(1, 10000)) }}">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{ route('main.index') }}">🏖️ Venta de Vacaciones</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('main.index') }}">Ofertas</a>
            </li>

            @auth
              <!-- Opciones para advanced y admin: crear ofertas -->
              @if(Auth::user()->isAdvanced() || Auth::user()->isAdmin())
              <li class="nav-item">
                <a class="nav-link" href="{{ route('vacacion.create') }}">Nueva Oferta</a>
              </li>
              @endif

              <!-- Opciones solo para admin: gestionar usuarios -->
              @if(Auth::user()->isAdmin())
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Administrar
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('user.index') }}">Usuarios</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.create') }}">Crear usuario</a></li>
                </ul>
              </li>
              @endif

              <!-- Mis reservas (todos los autenticados) -->
              <li class="nav-item">
                <a class="nav-link" href="{{ route('reserva.index') }}">Mis Reservas</a>
              </li>
            @endauth
          </ul>

          <!-- Barra de búsqueda (solo en la página principal) -->
          @if(Route::currentNamedAs('main.index'))
          <form class="d-flex me-2" role="search" method="get" action="{{ route('main.index') }}">
            @foreach(request()->except(['page', 'q']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input class="form-control me-2" name="q" type="search" placeholder="Buscar ofertas..." aria-label="Search" value="{{ $q ?? '' }}">
            <button class="btn btn-outline-light" type="submit">Buscar</button>
          </form>
          @endif

          <!-- Login / Logout -->
          <ul class="navbar-nav">
            @guest
            <li class="nav-item">
              <a class="btn btn-outline-light" href="{{ route('login') }}">Iniciar sesión</a>
            </li>
            <li class="nav-item ms-2">
              <a class="btn btn-outline-light" href="{{ route('register') }}">Registrarse</a>
            </li>
            @else
              <li class="nav-item">
                <a class="btn btn-outline-light" href="{{ route('home') }}">{{ Auth::user()->name }}</a>
              </li>
              <li class="nav-item ms-2">
                <form method="post" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="btn btn-outline-light">Cerrar sesión</button>
                </form>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <div class="container my-5">

        <!-- Mensajes de error -->
        @error('general')
        <div class="alert alert-danger">
          {{ $message }}
        </div>
        @enderror

        <!-- Mensajes de éxito -->
        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        @yield('modal')
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"></script>
    @yield('scripts')
    <script src="{{ url('assets/js/main.js?r=' . rand(1, 10000)) }}"></script>
  </body>

</html>