<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacacionCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|min:4|max:100|string',
            'descripcion' => 'required|min:20',
            'precio' => 'required|numeric|min:0',
            'pais' => 'required|min:3|max:100|string',
            'idtipo' => 'required|exists:tipo,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 4 caracteres.',
            'titulo.max' => 'El título no puede superar los 100 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 20 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'pais.required' => 'El país es obligatorio.',
            'idtipo.required' => 'Debes seleccionar un tipo de vacación.',
            'idtipo.exists' => 'El tipo seleccionado no existe.',
        ];
    }
}