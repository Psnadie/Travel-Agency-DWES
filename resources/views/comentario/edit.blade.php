@extends('template.base')

@section('content')
<h2>Editar comentario</h2>
<hr>
<form action="{{ route('comentario.update', $comentario->id) }}" method="post">
    @csrf
    @method('put')

    <div class="upper-space" style="padding-top: 16px;">
        @error('texto')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="texto">Comentario</label>
        <textarea cols="60" rows="4" class="form-control" required id="texto" name="texto" placeholder="Escribe tu comentario...">{{ old('texto', $comentario->texto) }}</textarea>
    </div>

    <div class="upper-space" style="padding-top: 16px;">
        <input class="btn btn-primary" type="submit" value="Guardar comentario">
        <a href="{{ route('vacacion.show', $comentario->idvacacion) }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
@endsection