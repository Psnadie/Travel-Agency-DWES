@extends('template.base')

@section('modal')
<!-- Modal de eliminación (mismo patrón que el ejemplo) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmar eliminación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres eliminar al usuario <span id="modal-news-title"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-danger">Eliminar usuario</button>
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
<h2>Gestión de Usuarios</h2>
<hr>

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Verificado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->rol }}</td>
            <td>@if($user->hasVerifiedEmail()) ✓ @else ✗ @endif</td>
            <td>
                <a href="{{ route('user.show', $user->id) }}" class="btn btn-success btn-sm">Ver</a>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <a data-title="{{ $user->name }}" data-href="{{ route('user.destroy', $user->id) }}" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Total de usuarios:</th>
            <th>{{ count($users) }}</th>
        </tr>
    </tfoot>
</table>
@endsection