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
            'nombre' => ucwords(trim($this->nombre))
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
            'nombre' => ['required', 'unique:distribucions,nombre,'.$this->id]
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debe escribir un nombre',
            'nombre.unique' => 'Esta distribución ya existe'
        ];

    }
}
