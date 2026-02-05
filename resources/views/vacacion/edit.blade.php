@extends('template.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header con icono -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <i class="bi bi-pencil-square" style="font-size: 4rem; color: #ffc107;"></i>
                </div>
                <h2 class="mb-2">Editar oferta</h2>
                <p class="text-muted">{{ $vacacion->titulo }}</p>
            </div>

            <!-- Formulario en card elegante -->
            <div class="card shadow-lg" style="border: none; border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('vacacion.update', $vacacion->id) }}" method="post">
                        @csrf
                        @method('put')

                        <!-- Título -->
                        <div class="mb-4">
                            <label for="titulo" class="form-label fw-bold">
                                <i class="bi bi-card-heading"></i> Título de la oferta
                            </label>
                            <input class="form-control form-control-lg @error('titulo') is-invalid @enderror" 
                                   required 
                                   id="titulo" 
                                   minlength="3" 
                                   maxlength="100" 
                                   type="text" 
                                   name="titulo" 
                                   placeholder="Título de la oferta" 
                                   value="{{ old('titulo', $vacacion->titulo) }}"
                                   style="border-radius: 10px;">
                            @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="form-label fw-bold">
                                <i class="bi bi-text-paragraph"></i> Descripción
                            </label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      required 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="5" 
                                      placeholder="Descripción de la oferta"
                                      style="border-radius: 10px;">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fila con Precio y País -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="precio" class="form-label fw-bold">
                                    <i class="bi bi-currency-euro"></i> Precio
                                </label>
                                <div class="input-group">
                                    <input class="form-control @error('precio') is-invalid @enderror" 
                                           required 
                                           id="precio" 
                                           type="number" 
                                           step="0.01" 
                                           min="0" 
                                           name="precio" 
                                           placeholder="999.99" 
                                           value="{{ old('precio', $vacacion->precio) }}"
                                           style="border-radius: 10px 0 0 10px;">
                                    <span class="input-group-text" style="border-radius: 0 10px 10px 0;">€</span>
                                    @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="pais" class="form-label fw-bold">
                                    <i class="bi bi-geo-alt-fill"></i> País
                                </label>
                                <input class="form-control @error('pais') is-invalid @enderror" 
                                       required 
                                       id="pais" 
                                       minlength="2" 
                                       maxlength="100" 
                                       type="text" 
                                       name="pais" 
                                       placeholder="País de destino" 
                                       value="{{ old('pais', $vacacion->pais) }}"
                                       style="border-radius: 10px;">
                                @error('pais')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tipo de vacación -->
                        <div class="mb-4">
                            <label for="idtipo" class="form-label fw-bold">
                                <i class="bi bi-tag-fill"></i> Tipo de vacación
                            </label>
                            <select required 
                                    name="idtipo" 
                                    id="idtipo" 
                                    class="form-select form-select-lg @error('idtipo') is-invalid @enderror"
                                    style="border-radius: 10px;">
                                <option value="" @if(old('idtipo', $vacacion->idtipo) == null) selected @endif disabled>
                                    Selecciona un tipo...
                                </option>
                                @foreach($tipos as $i => $tipo)
                                    <option value="{{ $i }}" @if($i == old('idtipo', $vacacion->idtipo)) selected @endif>
                                        {{ $tipo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idtipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-warning btn-lg" style="border-radius: 10px;">
                                <i class="bi bi-save-fill"></i> Guardar cambios
                            </button>
                            <a href="{{ route('vacacion.show', $vacacion->id) }}" class="btn btn-outline-secondary" style="border-radius: 10px;">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection














