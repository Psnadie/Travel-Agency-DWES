@extends('template.base')

@section('modal')
<!-- Modal de eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmar cancelación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres cancelar la reserva de <span id="modal-news-title"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button form="form-delete" type="submit" class="btn btn-danger">Cancelar reserva</button>
      </div>
    </div>
  </div>
</div>

<form id="form-delete" action="" method="post">
    @csrf
    @method('delete')
</form>
@endsection

@section('content')
<h2>Mis Reservas</h2>
<hr>

@if($reservas->count() > 0)
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-2">
    @foreach($reservas as $reserva)
    <div class="col">
        <div class="card shadow-sm h-100">
            <img src="{{ $reserva->vacacion->getPortada() }}" class="card-img-top" alt="{{ $reserva->vacacion->titulo }}" style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $reserva->vacacion->titulo }}</h5>
                <p class="card-text text-muted">{{ $reserva->vacacion->tipo->nombre }} · {{ $reserva->vacacion->pais }}</p>
                <p class="card-text"><strong>{{ number_format($reserva->vacacion->precio, 2) }} €</strong></p>
                <p class="card-text text-muted small">Reservado: {{ $reserva->created_at->format('d/m/Y') }}</p>

                <div class="mt-auto">
                    <a href="{{ route('vacacion.show', $reserva->vacacion->id) }}" class="btn btn-sm btn-outline-secondary">Ver oferta</a>
                    <a data-title="{{ $reserva->vacacion->titulo }}" data-href="{{ route('reserva.destroy', $reserva->id) }}" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Paginación -->
<div class="row">
    {{ $reservas->links() }}
</div>

@else
<div class="alert alert-info text-center">
    No tienes reservas todavía. <a href="{{ route('main.index') }}">Explora nuestras ofertas</a>
</div>
@endif
@endsection