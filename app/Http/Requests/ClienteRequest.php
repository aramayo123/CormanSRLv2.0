<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cliente' => 'required|string|unique:clientes',
        ];
    }

    public function attributes()
    {
        return [
            'cliente' => 'cliente'
        ];
    }
    public function messages()
    {
        return [
            'cliente.required' => 'El cliente es obligatorio.',
            'cliente.string' => 'El cliente debe ser un texto.',
            'cliente.unique' => 'El cliente ya existe.',
        ];
    }
}
