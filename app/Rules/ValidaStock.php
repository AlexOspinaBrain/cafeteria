<?php

namespace App\Rules;

use App\Models\Producto;
use Illuminate\Contracts\Validation\Rule;

class ValidaStock implements Rule
{

    private $producto_id = "";
    private $message = "";

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($producto_id)
    {
        $this->producto_id = $producto_id; 

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $valReturn = true;

        $product = Producto::where('id', $this->producto_id)->first();
        if ($product->stock < $value) {
            $this->message = "No tiene la cantidad solicitada de este producto en stock";
            $valReturn = false;
        }
            
        return $valReturn;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
