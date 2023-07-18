<?php

namespace App\Http\Requests\Users;

use App\Http\Traits\CustomResponses;
use Illuminate\Contracts\Validation\{ValidationRule, Validator};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            "id" => "required|int|exists:users,id",
            "name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "email" => "required|email|max:255",
            "phone" => "required|string|max:10",
            "document" => "required|string|max:13",
            "document_type" => "required|int|exists:document_types,id",
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El campo ID es obligatorio.',
            'id.int' => 'El campo ID debe ser un número entero.',
            'id.exists' => 'El ID proporcionado no existe en la tabla de usuarios.',
            'name.required' => 'El campo de nombre es obligatorio.',
            'name.string' => 'El campo de nombre debe ser una cadena de texto.',
            'name.max' => 'El campo de nombre no debe exceder los :max caracteres.',
            'last_name.required' => 'El campo de apellido es obligatorio.',
            'last_name.string' => 'El campo de apellido debe ser una cadena de texto.',
            'last_name.max' => 'El campo de apellido no debe exceder los :max caracteres.',
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El campo de correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El campo de correo electrónico no debe exceder los :max caracteres.',
            'email.unique' => 'El correo electrónico proporcionado ya está registrado.',
            'phone.required' => 'El campo de teléfono es obligatorio.',
            'phone.string' => 'El campo de teléfono debe ser una cadena de texto.',
            'phone.max' => 'El campo de teléfono no debe exceder los :max caracteres.',
            'document.required' => 'El campo de documento es obligatorio.',
            'document.string' => 'El campo de documento debe ser una cadena de texto.',
            'document.max' => 'El campo de documento no debe exceder los :max caracteres.',
            'document_type.required' => 'El campo de tipo de documento es obligatorio.',
            'document_type.int' => 'El campo de tipo de documento debe ser un número entero.',
            'document_type.exists' => 'El tipo de documento seleccionado no existe.',
        ];
    }
}
