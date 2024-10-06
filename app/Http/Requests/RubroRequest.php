<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RubroRequest extends FormRequest
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
        $id = $this->route('rubro');
        return [
            'rubro' => ['required','string',Rule::unique('rubros')->ignore($id)],
        ];
    }

    public function attributes()
    {
        return [
            'rubro' => 'rubro'
        ];
    }
    public function messages()
    {
        return [
            'rubro.required' => 'El rubro es obligatorio.',
            'rubro.string' => 'El rubro debe ser un texto.',
            'rubro.unique' => 'El rubro ya existe.',
        ];
    }
}
