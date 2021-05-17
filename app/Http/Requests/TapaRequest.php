<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TapaRequest extends FormRequest
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
            'nombre' => ['required','unique:tapas,nombre,'.$this->id], 
            'precio' => ['required', 'numeric', 'min: 0.05', 'max: 200']
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debe indicar un nombre para el plato',
            'nombre.unique' => 'Este plato ya existe. Debe indicar un nombre único.',
            'precio.required' => 'Debe indicar un precio para el plato',
            'precio.numeric' => 'El campo de precio debe ser numérico',
            'precio.min' => 'El precio debe ser como mínimo de 0.05 €',
            'precio.max' => 'El precio no puede ser más alto de 200€',
            'tipotapa_id' => 'Debe indicar un tipo de plato'
        ];
    }
}
