<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'texto' => 'required|min:10|max:500',
            'idvacacion' => 'required|exists:vacacion,id',
        ];
    }

    public function messages(): array
    {
        return [
            'texto.required' => 'El comentario es obligatorio.',
            'texto.min' => 'El comentario debe tener al menos 10 caracteres.',
            'texto.max' => 'El comentario no puede superar los 500 caracteres.',
            'idvacacion.required' => 'Debes seleccionar una vacación.',
            'idvacacion.exists' => 'La vacación seleccionada no existe.',
        ];
    }
}