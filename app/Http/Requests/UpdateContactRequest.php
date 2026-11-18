<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'name_contact' => ['sometimes', 'nullable', 'string', 'max:255'],
            'email_contact' => ['sometimes', 'nullable', 'email', 'max:255'],
            'social_contact' => ['sometimes', 'nullable', 'string', 'max:2048'],
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
            'name_contact.string' => 'O nome de contato deve ser um texto válido.',
            'name_contact.max' => 'O nome de contato não pode ter mais de 255 caracteres.',
            'email_contact.email' => 'O e-mail de contato deve ser um endereço válido.',
            'social_contact.string' => 'O link das redes sociais deve ser um texto válido.',
        ];
    }
}
