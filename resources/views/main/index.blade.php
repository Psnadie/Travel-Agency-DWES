@extends('template.base')

@section('modal')
<!-- Modal: Ordenar -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="orderModalLabel">Ordenar ofertas por ...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled">
            <li><a href="{{ route('main.index', array_merge(request()->except(['page', 'campo', 'orden']), ['campo' => 'recent', 'orden' => 'desc'])) }}" class="btn btn-outline-primary mb-1">Las ofertas más recientes</a></li>
            <li><a href="{{ route('main.index', array_merge(request()->except(['page', 'campo', 'orden']), ['campo' => 'recent', 'orden' => 'asc'])) }}" class="btn btn-outline-primary mb-1">Las ofertas más antiguas</a></li>
            <li><a href="{{ route('main.index', array_merge(request()->except(['page', 'campo', 'orden']), ['campo' => 'titulo', 'orden' => 'asc'])) }}" class="btn btn-outline-primary mb-1">Título A → Z</a></li>
            <li><a href="{{ route('main.index', array_merge(request()->except(['page', 'campo', 'orden']), ['campo' => 'titulo', 'orden' => 'desc'])) }}" class="btn btn-outline-primary mb-1">Título Z → A</a></li>
            <li><a href="{{ route('main.index', array_merge(request()->except(['page', 'campo', 'orden']), ['campo' => 'precio', 'orden' => 'asc'])) }}" class="btn btn-outline-primary mb-1">Precio: más barato</a></li>
            <li><a href="{{ route('main.index', array_merge(request()->except(['page', 'campo', 'orden']), ['campo' => 'precio', 'orden' => 'desc'])) }}" class="btn btn-outline-primary mb-1">Precio: más caro</a></li>
            <li><a href="{{ route('main.index', array_merge(request()->except(['page', 'campo', 'orden']), ['campo' => 'pais', 'orden' => 'asc'])) }}" class="btn btn-outline-primary mb-1">País A → Z</a></li>
            <li><a href="{{ route('main.index', array_merge(request()->except(['page', 'campo', 'orden']), ['campo' => 'pais', 'orden' => 'desc'])) }}" class="btn btn-outline-primary mb-1">País Z → A</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Filtrar -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filterModalLabel">Filtrar ofertas por ...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="filterForm" action="{{ route('main.index') }}" method="get">
            <!-- Campos ocultos para mantener búsqueda y ordenamiento -->
            <input type="hidden" name="campo" value="{{ $campo }}">
            <input type="hidden" name="orden" value="{{ $orden }}">
            <input type="hidden" name="q" value="{{ $q }}">

            <!-- Filtro por tipo -->
            <label for="idtipo" class="form-label">Tipo de vacación</label>
            <select name="idtipo" id="idtipo" class="form-control mb-3">
                <option value="" @if($idtipo == null) selected @endif>Todos los tipos</option>
                @foreach($tipos as $i => $tipo)
                    <option value="{{ $i }}" @if($i == $idtipo) selected @endif>{{ $tipo }}</option>
                @endforeach
            </select>

            <!-- Filtro por país -->
            <label for="pais" class="form-label">País</label>
            <input type="text" class="form-control mb-3" name="pais" id="pais" value="{{ $pais }}" placeholder="Ej: España">

            <!-- Filtro por rango de precio -->
            <label class="form-label">Rango de precio (€)</label>
            <div class="row">
                <div class="col">
                    <input type="number" class="form-control" name="precio_min" value="{{ $precio_min }}" placeholder="Mínimo" min="0" step="1">
                </div>
                <div class="col-auto d-flex align-items-center">a</div>
                <div class="col">
                    <input type="number" class="form-control" name="precio_max" value="{{ $precio_max }}" placeholder="Máximo" min="0" step="1">
                </div>
            </div>

            <input type="submit" class="btn btn-primary form-control mt-3" value="Filtrar">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

<!-- Botones de ordenar y filtrar -->
<div class="mb-4">
    <a class="btn btn-info mb-2 me-2" data-bs-toggle="modal" data-bs-target="#orderModal">
        Ordenar por ...
    </a>
    <a class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#filterModal">
        Filtrar por ...
    </a>
</div>

<!-- Tarjetas de ofertas -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
    @foreach($vacaciones as $vacacion)
        <div class="col">
            <div class="card shadow-sm h-100">
                <img src="{{ $vacacion->getPortada() }}"
                     class="card-img-top"
                     alt="{{ $vacacion->titulo }}"
                     style="height: 200px; object-fit: cover;">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $vacacion->titulo }}</h5>
                    <p class="card-text text-muted">
                        {{ $vacacion->tipo->nombre }} · {{ $vacacion->pais }}
                    </p>
                    <p class="card-text">
                        {{ Str::limit($vacacion->descripcion, 100) }}
                    </p>
                    <p class="card-text">
                        <strong>{{ number_format($vacacion->precio, 2) }} €</strong>
                    </p>

                    <div class="mt-auto">
                        <a href="{{ route('vacacion.show', $vacacion->id) }}"
                           class="btn btn-sm btn-outline-secondary">
                            Ver detalle
                        </a>

                        @if(Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ route('vacacion.edit', $vacacion->id) }}"
                               class="btn btn-sm btn-outline-warning">
                                Editar
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col d-flex justify-content-center">
        {{ $vacaciones->onEachSide(2)->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection