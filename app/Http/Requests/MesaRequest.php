<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MesaRequest extends FormRequest
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
            'nombre' => ['required', 'max:120'],
            'num_asientos' => ['required','numeric', 'min:1', 'max:30'],
            'ocupada' => 'required',
            'distribucion_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debe indicar un nombre',
            'nombre.max' => 'El nombre no debe tener más de 120 caracteres',
            'num_asientos.required' => 'Debe indicar un número de asientos',
            'num_asientos.min' => 'El mínimo de asientos es de 1',
            'num_asientos.max' => 'El máximo de asientos es de 30'
        ];
    }
}
