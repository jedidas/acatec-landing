<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name' => 'required|string|max:75',
            'subject' => 'required|string|max:180',
            'phone' => 'required|string|max:75',
            'email' => 'required|email|max:75',
            'message' => 'required|string|max:500',
        ];
    }


    public function messages(): array
    {
        return [
            // required
            'name.required'    => 'El campo nombre es obligatorio.',
            'subject.required' => 'El campo asunto es obligatorio.',
            'phone.required'   => 'El campo teléfono es obligatorio.',
            'email.required'   => 'El campo correo electrónico es obligatorio.',
            'message.required' => 'El campo mensaje es obligatorio.',

            'name.string'    => 'El nombre debe ser una cadena de texto.',
            'subject.string' => 'El asunto debe ser una cadena de texto.',
            'phone.string'   => 'El teléfono debe ser una cadena de texto.',
            'message.string' => 'El mensaje debe ser una cadena de texto.',

            'name.max'    => 'El nombre no debe superar los :max caracteres.',
            'subject.max' => 'El asunto no debe superar los :max caracteres.',
            'phone.max'   => 'El teléfono no debe superar los :max caracteres.',
            'email.max'   => 'El correo electrónico no debe superar los :max caracteres.',
            'message.max'   => 'El mensaje no debe superar los :max caracteres.',

            'email.email' => 'El correo electrónico debe ser una dirección válida.',
        ];
    }
}
