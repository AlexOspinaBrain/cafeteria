<?php

namespace App\Http\Requests;

use App\Rules\ValidaStock;
use Illuminate\Foundation\Http\FormRequest;

class VentaPostRequest extends FormRequest
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
            
            'cliente' => 'required',
            'producto_id' => 'required',
            'cantidad' => [ 'required',
                new ValidaStock(request()->producto_id),
            ],

        ];
    }
    public function messages(){

        return[
            'cliente.required' => 'Debe digitar el nombre del cliente.',
            'producto_id.required' => 'Debe seleccionar un producto.',
            'cantidad.required' => 'Debe digitar la cantidad.',
        ];
    }  
}
