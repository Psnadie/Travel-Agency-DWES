<!-- comentario/create.blade.php -->
<!-- Este archivo se incluye dentro de vacacion/show.blade.php con @include -->

<h4>Deja un comentario</h4>
<form action="{{ route('comentario.store') }}" method="post">
    @csrf
    <input type="hidden" name="idvacacion" value="{{ $vacacion->id }}">

    <div class="upper-space" style="padding-top: 16px;">
        @error('texto')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="texto">Comentario</label>
        <textarea cols="60" rows="4" class="form-control" required id="texto" name="texto" placeholder="Escribe tu comentario...">{{ old('texto') }}</textarea>
    </div>

    <div class="upper-space" style="padding-top: 16px;">
        <input class="btn btn-primary" type="submit" value="Publicar comentario">
    </div>
</form>