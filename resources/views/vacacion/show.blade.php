@extends('template.base')

@section('content')
<!-- Hero Section con imagen de fondo completa -->
<div class="vacation-hero" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.5)), url('{{ $vacacion->getPortada() }}') center/cover no-repeat; min-height: 500px; display: flex; align-items: center; justify-content: center; color: white; text-align: center; margin-bottom: 3rem; border-radius: 0 0 20px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <span class="badge bg-light text-dark mb-3" style="font-size: 1rem; padding: 0.5rem 1rem;">
                    <i class="bi bi-tag-fill"></i> {{ $vacacion->tipo->nombre }}
                </span>
                <h1 class="display-3 fw-bold mb-3" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
                    {{ $vacacion->titulo }}
                </h1>
                <p class="lead mb-4" style="font-size: 1.5rem;">
                    <i class="bi bi-geo-alt-fill"></i> {{ $vacacion->pais }}
                </p>
                <h2 class="display-5 mb-4" style="color: #ffc107; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                    {{ number_format($vacacion->precio, 2) }} €
                </h2>

                <!-- Botón de reserva destacado -->
                @auth
                    @if(!$tieneReserva)
                    <form action="{{ route('reserva.store') }}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="idvacacion" value="{{ $vacacion->id }}">
                        <button type="submit" class="btn btn-success btn-lg px-5 py-3" style="border-radius: 50px; font-size: 1.2rem; box-shadow: 0 4px 15px rgba(40,167,69,0.4);">
                            <i class="bi bi-ticket-perforated-fill"></i> Reservar esta oferta
                        </button>
                    </form>
                    @else
                    <span class="badge bg-success p-3" style="font-size: 1.2rem; border-radius: 20px;">
                        <i class="bi bi-check-circle-fill"></i> Ya tienes esta oferta reservada
                    </span>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 py-3" style="border-radius: 50px; font-size: 1.2rem; border-width: 2px;">
                        <i class="bi bi-box-arrow-in-right"></i> Inicia sesión para reservar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Descripción y detalles -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Botones de admin (solo si es admin) -->
            @if(Auth::check() && Auth::user()->isAdmin())
            <div class="mb-4 text-center">
                <a href="{{ route('vacacion.edit', $vacacion->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i> Editar oferta
                </a>
                <a data-title="{{ $vacacion->titulo }}" data-href="{{ route('vacacion.destroy', $vacacion->id) }}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash-fill"></i> Eliminar oferta
                </a>
            </div>
            @endif

            <!-- Descripción en card elegante -->
            <div class="card shadow-sm mb-5" style="border: none; border-radius: 15px;">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4"><i class="bi bi-info-circle-fill text-primary"></i> Descripción</h3>
                    <p class="card-text" style="font-size: 1.1rem; line-height: 1.8;">
                        {{ $vacacion->descripcion }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Galería de fotos mejorada -->
@if($vacacion->fotos->count() > 0)
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="text-center mb-4"><i class="bi bi-images"></i> Galería de fotos</h2>
            <div class="row g-3">
                @foreach($vacacion->fotos as $foto)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm" style="border: none; border-radius: 15px; overflow: hidden;">
                        <img src="{{ url('storage/' . $foto->ruta) }}" alt="Foto de {{ $vacacion->titulo }}" class="card-img-top" style="height: 250px; object-fit: cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <div class="card-body text-center p-2">
                            <form action="{{ route('foto.destroy', $foto->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta foto?')">
                                    <i class="bi bi-trash-fill"></i> Eliminar
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<!-- Subir foto (solo advanced y admin) -->
@if(Auth::check() && (Auth::user()->isAdvanced() || Auth::user()->isAdmin()))
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm" style="border: none; border-radius: 15px; background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;">
                <div class="card-body p-4">
                    <h3 class="card-title mb-3"><i class="bi bi-cloud-upload-fill"></i> Añadir foto</h3>
                    <form action="{{ route('foto.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="idvacacion" value="{{ $vacacion->id }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-8">
                                @error('foto')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="foto" class="form-label fw-bold">Selecciona una imagen</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required style="background: white;">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-light w-100">
                                    <i class="bi bi-upload"></i> Subir foto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Sección de comentarios mejorada -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="text-center mb-4"><i class="bi bi-chat-dots-fill"></i> Comentarios</h2>

            <!-- Lista de comentarios -->
            @if($vacacion->comentarios->count() > 0)
            <div class="mb-4">
                @foreach($vacacion->comentarios as $comentario)
                <div class="card mb-3 shadow-sm" style="border: none; border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1"><i class="bi bi-person-circle"></i> {{ $comentario->user->name }}</h5>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3"></i> {{ $comentario->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div>
                                @if(Auth::check() && $comentario->isOwner())
                                    <a href="{{ route('comentario.edit', $comentario->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                @endif
                                @if(Auth::check() && ($comentario->isOwner() || Auth::user()->isAdmin()))
                                    <form action="{{ route('comentario.destroy', $comentario->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar este comentario?')">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <p class="mb-0" style="font-size: 1.05rem; line-height: 1.6;">{{ $comentario->texto }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i> Aún no hay comentarios. ¡Sé el primero en comentar!
            </div>
            @endif

            <!-- Formulario de nuevo comentario -->
            @if(Auth::check() && $tieneReserva)
            <div class="card shadow-sm" style="border: none; border-radius: 15px; background: #f8f9fa;">
                <div class="card-body p-4">
                    @include('comentario.create')
                </div>
            </div>
            @elseif(Auth::check() && !$tieneReserva)
            <div class="alert alert-warning text-center">
                <i class="bi bi-exclamation-triangle-fill"></i> Debes reservar esta oferta antes de poder comentar.
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal de eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 15px;">
      <div class="modal-header border-0">
        <h1 class="modal-title fs-5" id="deleteModalLabel">
            <i class="bi bi-exclamation-triangle-fill text-danger"></i> Confirmar eliminación
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que quieres eliminar la oferta <strong id="modal-news-title"></strong>?
        <br><small class="text-muted">Esta acción no se puede deshacer.</small>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-danger">
            <i class="bi bi-trash-fill"></i> Eliminar
        </button>
      </div>
    </div>
  </div>
</div>

<form id="form-delete" action="" method="post">
    @csrf
    @method('delete')
</form>

<!-- Añadir Bootstrap Icons si no está incluido ya -->
@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@endsection