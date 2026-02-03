@extends('template.base')

@section('content')
<!-- Header con imagen portada -->
<header class="masthead" style="background-image: url('{{ $vacacion->getPortada() }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $vacacion->titulo }}</h1>
                    <h2 class="subheading">{{ $vacacion->tipo->nombre }} · {{ $vacacion->pais }}</h2>
                    <span class="meta">Precio: <strong>{{ number_format($vacacion->precio, 2) }} €</strong></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Descripción -->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>{{ $vacacion->descripcion }}</p>

                <!-- Botones admin: editar / eliminar -->
                @if(Auth::check() && Auth::user()->isAdmin())
                <div class="mb-3">
                    <a href="{{ route('vacacion.edit', $vacacion->id) }}" class="btn btn-outline-warning btn-sm">Editar oferta</a>
                    <a data-title="{{ $vacacion->titulo }}" data-href="{{ route('vacacion.destroy', $vacacion->id) }}" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar oferta</a>
                </div>
                @endif

                <!-- Botón reservar -->
                @auth
                    @if(!$tieneReserva)
                    <form action="{{ route('reserva.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="idvacacion" value="{{ $vacacion->id }}">
                        <button type="submit" class="btn btn-success">🎟️ Reservar esta oferta</button>
                    </form>
                    @else
                    <span class="badge bg-success fs-6">✓ Ya tienes esta oferta reservada</span>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Inicia sesión para reservar</a>
                @endauth
            </div>
        </div>
    </div>
</article>

<hr>

<!-- Galería de fotos -->
@if($vacacion->fotos->count() > 0)
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2>Galería</h2>
                <div class="row">
                    @foreach($vacacion->fotos as $foto)
                    <div class="col-md-4 mb-3">
                        <img src="{{ url('storage/' . $foto->ruta) }}" alt="Foto" class="img-fluid rounded shadow-sm">
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <form action="{{ route('foto.destroy', $foto->id) }}" method="post" class="mt-1 text-center">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta foto?')">Eliminar foto</button>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</article>
<hr>
@endif

<!-- Subir foto (solo advanced y admin) -->
@if(Auth::check() && (Auth::user()->isAdvanced() || Auth::user()->isAdmin()))
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2>Añadir foto</h2>
                <form action="{{ route('foto.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idvacacion" value="{{ $vacacion->id }}">
                    <div class="mb-3">
                        @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="file" class="form-control" name="foto" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Subir foto</button>
                </form>
            </div>
        </div>
    </div>
</article>
<hr>
@endif

<!-- Comentarios -->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2>Comentarios</h2>

                @foreach($vacacion->comentarios as $comentario)
                    <p>
                        {{ $comentario->texto }}
                        <!-- Editar: solo el dueño del comentario -->
                        @if(Auth::check() && $comentario->isOwner())
                            <a href="{{ route('comentario.edit', $comentario->id) }}" class="btn btn-link btn-sm p-0">editar</a>
                        @endif
                        <!-- Eliminar: dueño o admin -->
                        @if(Auth::check() && ($comentario->isOwner() || Auth::user()->isAdmin()))
                            <form action="{{ route('comentario.destroy', $comentario->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link btn-sm text-danger p-0" onclick="return confirm('¿Eliminar este comentario?')">eliminar</button>
                            </form>
                        @endif
                    </p>
                    <p class="text-end text-muted">
                        {{ $comentario->user->name }} - {{ $comentario->created_at->format('d/m/Y') }}
                    </p>
                    <hr>
                @endforeach

                <!-- Formulario de nuevo comentario (solo si tiene reserva) -->
                @if(Auth::check() && $tieneReserva)
                    @include('comentario.create')
                @endif
            </div>
        </div>
    </div>
</article>

<!-- Modal de eliminación (mismo patrón que el ejemplo) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmar eliminación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres eliminar la oferta <span id="modal-news-title"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<form id="form-delete" action="" method="post">
    @csrf
    @method('delete')
</form>
@endsection