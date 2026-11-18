<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillRequest extends FormRequest
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
            'title_details' => ['sometimes', 'nullable', 'string', 'max:255'],
            'details' => ['sometimes', 'nullable', 'string'],
            'details_icons' => ['sometimes', 'nullable', 'string', 'max:255'],
            'icons' => ['sometimes', 'nullable', 'string', 'max:2048'],
            'icons_file' => ['sometimes', 'nullable', 'file', 'image', 'mimes:jpeg,png,jpg,svg', 'max:5120'],
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
            'title.string' => 'O título deve ser um texto válido.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',
            'description.string' => 'A descrição deve ser um texto válido.',
            'title_details.string' => 'O título dos detalhes deve ser um texto válido.',
            'details.string' => 'Os detalhes devem ser um texto válido.',
            'icons.string' => 'O link do ícone deve ser um texto válido.',
            'icons_file.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'icons_file.mimes' => 'A imagem do ícone deve estar em um dos formatos: jpeg, png, jpg ou svg.',
            'icons_file.max' => 'O arquivo do ícone não pode ser maior que 5MB.',
        ];
    }
}
