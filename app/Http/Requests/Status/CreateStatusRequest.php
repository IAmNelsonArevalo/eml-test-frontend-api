<?php

namespace App\Http\Requests\Status;

use App\Http\Traits\CustomResponses;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\{ValidationRule, Validator};
use Illuminate\Foundation\Http\FormRequest;

class CreateStatusRequest extends FormRequest
{
    use CustomResponses;

    protected function failedValidation(Validator $validator)
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
            'name' => 'required|string',
            'model' => 'required|string',
            'color_status' => 'required|string',
            'translate_status' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'model.required' => 'El campo modelo es obligatorio.',
            'color_status.required' => 'El campo color del estado es obligatorio.',
            'translate_status.required' => 'El campo traducción del estado es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'model.string' => 'El campo modelo debe ser una cadena de caracteres.',
            'color_status.string' => 'El campo color del estado debe ser una cadena de caracteres.',
            'translate_status.string' => 'El campo traducción del estado debe ser una cadena de caracteres.',
        ];
    }
}
