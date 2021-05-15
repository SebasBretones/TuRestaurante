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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'num_asientos' => ['required','numeric', 'min:1', 'max:30'],
            'ocupada' => 'required',
            'distribucion_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'num_asientos.required' => 'Debe indicar un número de asientos',
            'num_asientos.min' => 'El mínimo de asientos es de 1',
            'num_asientos.max' => 'El máximo de asientos es de 30'
        ];
    }
}
