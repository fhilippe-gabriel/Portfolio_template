<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSkillLogoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'alt' => ['nullable', 'string', 'max:255'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'logo_file' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,svg,gif,webp', 'max:5120'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'logo_file.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'logo_file.mimes' => 'A logo deve ser JPEG, PNG, JPG, SVG, GIF ou WEBP.',
            'logo_file.max' => 'A logo não pode ter mais de 5MB.',
        ];
    }
}
