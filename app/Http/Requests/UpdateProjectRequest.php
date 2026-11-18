<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'description' => ['sometimes', 'nullable', 'string'],
            'link' => ['sometimes', 'nullable', 'string', 'max:2048'],
            'imagem' => ['sometimes', 'nullable', 'string', 'max:2048'],
            'imagem_file' => ['sometimes', 'nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.string' => 'O título do projeto deve ser um texto válido.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',
            'description.string' => 'A descrição do projeto deve ser um texto válido.',
            'link.string' => 'O link do projeto deve ser um texto ou URL válido.',
            'imagem.string' => 'A URL da imagem deve ser um texto válido.',
            'imagem_file.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'imagem_file.mimes' => 'A imagem do projeto deve estar em um dos formatos: jpeg, png ou jpg.',
            'imagem_file.max' => 'O arquivo de imagem não pode ser maior que 5MB.',
        ];
    }
}
