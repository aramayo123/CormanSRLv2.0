<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Material;
use Illuminate\Validation\Rule;

class MaterialRequest extends FormRequest
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
        $id = $this->route('materiale'); // Obtén el ID del usuario desde la ruta o de donde lo estés enviando
        return [
            'rubro_id' => ['required'],
            'descripcion' => ['required', 'string', Rule::unique('materiales')->ignore($id)],
            'unidad' => ['required','string'],
       ];
    }
    public function messages()
    {
        return [
            'descripcion.unique' => 'La descripcion del material ya existe.',
        ];
    }
}
