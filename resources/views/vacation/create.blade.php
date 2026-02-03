@extends('template.base')

@section('content')
<h2>Nueva oferta vacacional</h2>
<hr>
<form action="{{ route('vacacion.store') }}" method="post">
    @csrf

    <div class="upper-space" style="padding-top: 16px;">
        @error('titulo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="titulo">Título</label>
        <input class="form-control" required id="titulo" minlength="3" maxlength="100" type="text" name="titulo" placeholder="Título de la oferta" value="{{ old('titulo') }}">
    </div>

    <div class="upper-space" style="padding-top: 16px;">
        @error('descripcion')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="descripcion">Descripción</label>
        <textarea cols="60" rows="5" class="form-control" required id="descripcion" name="descripcion" placeholder="Descripción de la oferta">{{ old('descripcion') }}</textarea>
    </div>

    <div class="upper-space" style="padding-top: 16px;">
        @error('precio')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="precio">Precio (€)</label>
        <input class="form-control" required id="precio" type="number" step="0.01" min="0" name="precio" placeholder="Precio" value="{{ old('precio') }}">
    </div>

    <div class="upper-space" style="padding-top: 16px;">
        @error('pais')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="pais">País</label>
        <input class="form-control" required id="pais" minlength="2" maxlength="100" type="text" name="pais" placeholder="País de destino" value="{{ old('pais') }}">
    </div>

    <div class="upper-space" style="padding-top: 16px;">
        @error('idtipo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="idtipo">Tipo de vacación</label>
        <select required name="idtipo" id="idtipo" class="form-control">
            <option value="" @if(old('idtipo') == null) selected @endif disabled>Selecciona un tipo...</option>
            @foreach($tipos as $i => $tipo)
                <option value="{{ $i }}" @if($i == old('idtipo')) selected @endif>{{ $tipo }}</option>
            @endforeach
        </select>
    </div>

    <div class="upper-space" style="padding-top: 16px;">
        <input class="btn btn-primary" type="submit" value="Crear oferta">
    </div>
</form>
@endsection