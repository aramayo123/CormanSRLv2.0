<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FotoCorRequest extends FormRequest
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
            'foto_antes' => 'mimes:png,jpg,jpeg,mp4,mov,webm',
            'foto_despues' => 'mimes:png,jpg,jpeg,mp4,mov,webm',
            'foto_ot' => 'mimes:png,jpg,jpeg,mp4,mov,webm',
            'foto_boleta' => 'mimes:png,jpg,jpeg,mp4,mov,webm',
        ];
    }
    public function messages()
    {
        return [
            'foto_antes.mimes' => 'La imagen debe estar en formato: <p class="inline-block text-red-500">PNG,JPG,JPEG,MP4,WEBM</p>.',
            'foto_despues.mimes' => 'La imagen debe estar en formato: <p class="inline-block text-red-500">PNG,JPG,JPEG,MP4,WEBM</p>.',
            'foto_ot.mimes' => 'La imagen debe estar en formato: <p class="inline-block text-red-500">PNG,JPG,JPEG,MP4,WEBM</p>.',
            'foto_boleta.mimes' => 'La imagen debe estar en formato: <p class="inline-block text-red-500">PNG,JPG,JPEG,MP4,WEBM</p>.',
        ];
    }
}
