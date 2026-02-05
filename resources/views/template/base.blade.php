<!doctype html>
<html lang="es">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Agencia de Viajes Premium')</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      :root {
        --primary-color: #0d6efd;
        --secondary-color: #6c757d;
        --success-color: #12cc75;
        --danger-color: #dc3545;
        --dark-color: #212529;
      }

      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
      }

      .navbar {
        background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      }

.btn-info {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    border: none !important;
    color: white !important;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    transition: all 0.3s ease;
}

.btn-info:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
}

.btn-info:active {
    transform: translateY(0);
}

.btn-primary {
    background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
    border: none !important;
    color: white !important;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(74, 222, 128, 0.3);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(74, 222, 128, 0.4);
}

.btn-primary:active {
    transform: translateY(0);
}

.btn-success {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%) !important;
    border: none !important;
    color: white !important;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
    transition: all 0.3s ease;
}

.btn-success:hover {
    background: linear-gradient(135deg, #15803d 0%, #166534 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(22, 163, 74, 0.4);
}

.btn-success:active {
    transform: translateY(0);
}

.btn-outline-primary {
    border: 2px solid #22c55e !important;
    color: #22c55e !important;
    background: transparent !important;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
    border-color: #22c55e !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(74, 222, 128, 0.3);
}

.btn-outline-success {
    border: 2px solid #16a34a !important;
    color: #16a34a !important;
    background: transparent !important;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-success:hover {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%) !important;
    border-color: #16a34a !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
}

.btn-warning {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%) !important;
    border: none !important;
    color: white !important;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    transition: all 0.3s ease;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(251, 191, 36, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    border: none !important;
    color: white !important;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
}

.btn-secondary {
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
    border: none !important;
    color: white !important;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #4b5563 0%, #374151 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(107, 114, 128, 0.4);
}

.btn-light {
    background: #ffffff !important;
    border: 2px solid #e5e7eb !important;
    color: #374151 !important;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-light:hover {
    background: #f9fafb !important;
    border-color: #d1d5db !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.badge.bg-success {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%) !important;
}

.badge.bg-primary {
    background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
}

.badge.bg-info {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
}

.btn {
    border-radius: 8px;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
}

.btn-lg {
    border-radius: 12px;
    padding: 0.75rem 2rem;
}

.btn-sm {
    border-radius: 6px;
    padding: 0.375rem 1rem;
}

      .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
      }

      .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
      }

      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
      }

      .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden;
      }

      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      }

      .card-img-top {
        height: 250px;
        object-fit: cover;
      }

      .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
      }

      .alert {
        border-radius: 10px;
        border: none;
      }

      .container {
        max-width: 1400px;
      }

      .search-form {
        background: rgba(255,255,255,0.1);
        border-radius: 50px;
        padding: 0.25rem;
      }

      .search-form input {
        background: transparent;
        border: none;
        color: white;
      }

      .search-form input::placeholder {
        color: rgba(255,255,255,0.7);
      }

      .search-form input:focus {
        background: transparent;
        color: white;
        box-shadow: none;
      }

      .search-form .btn {
        border-radius: 50px;
      }

      .price-tag {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
      }

      .nav-link {
        transition: color 0.2s;
      }

      .nav-link:hover {
        color: rgba(255,255,255,0.8) !important;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="{{ route('main.index') }}">
          <i class="bi bi-airplane-fill"></i> TravelZaidin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('main.index') }}">
                <i class="bi bi-compass"></i> Explorar Destinos
              </a>
            </li>

            @auth
              <!-- Opciones para advanced y admin: crear ofertas -->
              @if(Auth::user()->isAdvanced() || Auth::user()->isAdmin())
              <li class="nav-item">
                <a class="nav-link" href="{{ route('vacacion.create') }}">
                  <i class="bi bi-plus-circle"></i> Nueva Oferta
                </a>
              </li>
              @endif

              <!-- Mis reservas (todos los autenticados) -->
              <li class="nav-item">
                <a class="nav-link" href="{{ route('reserva.index') }}">
                  <i class="bi bi-bookmark-check"></i> Mis Reservas
                </a>
              </li>
            @endauth
          </ul>

          <!-- Barra de búsqueda (solo en la página principal) -->
          @if(Route::currentRouteName() == 'main.index')
          <form class="d-flex me-3 search-form" role="search" method="get" action="{{ route('main.index') }}">
            @foreach(request()->except(['page', 'q']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input class="form-control me-2" name="q" type="search" placeholder="Buscar destinos..." aria-label="Search" value="{{ $q ?? '' }}">
            <button class="btn btn-light" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </form>
          @endif

          <!-- Login / Logout -->
          <ul class="navbar-nav">
            @guest
            <li class="nav-item">
              <a class="btn btn-outline-light me-2" href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
              </a>
            </li>
            <li class="nav-item">
              <a class="btn btn-light" href="{{ route('register') }}">
                <i class="bi bi-person-plus"></i> Registrarse
              </a>
            </li>
            @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('home') }}">
                    <i class="bi bi-house"></i> Mi Perfil
                  </a></li>
                  <li><a class="dropdown-item" href="{{ route('reserva.index') }}">
                    <i class="bi bi-bookmark-check"></i> Mis Reservas
                  </a></li>
                  @if(Auth::user()->isAdvanced() || Auth::user()->isAdmin())
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ route('vacacion.create') }}">
                    <i class="bi bi-plus-circle"></i> Nueva Oferta
                  </a></li>
                  @endif
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form method="post" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                      </button>
                    </form>
                  </li>
                </ul>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <div class="container my-5">

        <!-- Mensajes de error general -->
        @if($errors->has('general'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          {{ $errors->first('general') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Mensajes de error específico -->
        @if($errors->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          {{ $errors->first('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Mensajes de éxito -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i>
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('modal')
        @yield('content')

    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
      <div class="container">
        <p class="mb-0">&copy; {{ date('Y') }} TravelZaidin. Todos los derechos reservados.</p>
        <p class="mb-0 small">Tu agencia de viajes de confianza en españa (Proyecto de Nicolas Lopez 2DWES)</p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"></script>
    @yield('scripts')
  </body>

</html>