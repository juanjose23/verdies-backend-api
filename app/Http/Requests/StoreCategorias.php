<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorias extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255|unique:categorias', 
            'descripcion' => 'required|string',
            'estado' => 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            'nombre.unique' => 'El campo nombre debe ser unico, este valor ya esta en uso.',
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'descripcion.string' => 'El campo descripción debe ser una cadena de texto.',
            'estado.required' => 'El campo estado es obligatorio.',
        ];
    }
}
