<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'subtitle' => ['sometimes', 'nullable', 'string', 'max:500'],
            'description' => ['sometimes', 'nullable', 'string'],
            'user_imagem' => ['sometimes', 'nullable', 'string', 'max:2048'],
            'user_imagem_file' => ['sometimes', 'nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.string' => 'O título deve ser um texto válido.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',
            'subtitle.string' => 'O subtítulo deve ser um texto válido.',
            'subtitle.max' => 'O subtítulo não pode ter mais de 500 caracteres.',
            'description.string' => 'A descrição deve ser um texto válido.',
            'user_imagem.string' => 'O link da imagem deve ser um texto válido.',
            'user_imagem.max' => 'O link da imagem não pode ter mais de 2048 caracteres.',
            'user_imagem_file.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'user_imagem_file.mimes' => 'A imagem deve estar em um dos formatos permitidos: jpeg, png ou jpg.',
            'user_imagem_file.max' => 'O tamanho da imagem não pode exceder 5MB.',
        ];
    }
}
