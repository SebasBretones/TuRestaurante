<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistribucionesRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'nombre' => trim(ucwords(strtolower($this->nombre)))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debe escribir un nombre',
        ];

    }
}
