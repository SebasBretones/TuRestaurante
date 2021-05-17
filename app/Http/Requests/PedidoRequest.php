<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
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
            'tapa_id' => 'nullable',
            'bebida_id' => 'nullable', 
            'estado_id' => 'required',
            'mesa_id' => 'required',
            'cantidad' => ['required','numeric','min:1','max:30']
        ];
    }

    public function messages()
    {
        return [
            'cantidad.required' => 'Debe introducir la cantidad del pedido',
            'cantidad.min' => 'Debe introducir un minimo de 1 pedido.',
            'cantidad.max' => 'Debe introducir un máximo de 30 pedidos'
        ];
    }
}
