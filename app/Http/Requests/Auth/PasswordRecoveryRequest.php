<?php

namespace App\Http\Requests\Auth;

use App\Http\Traits\CustomResponses;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PasswordRecoveryRequest extends FormRequest
{
    use CustomResponses;

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException($this->error("Error.", $validator->errors()));
    }

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|string|exists:users,email|max:255",
            "password" => "required|string|max:255"
        ];
    }

    /**
     * Get the validation error messages.
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.string' => 'El campo de correo electrónico debe ser una cadena de texto.',
            'email.exists' => 'El correo electrónico proporcionado no está registrado.',
            'email.max' => 'El campo de correo electrónico no debe exceder los :max caracteres.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.string' => 'El campo de contraseña debe ser una cadena de texto.',
            'password.max' => 'El campo de contraseña no debe exceder los :max caracteres.'
        ];
    }
}
