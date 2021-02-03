<?php

namespace Vanguard\Http\Requests\Product;

use Vanguard\Http\Requests\Request;
use Vanguard\Product;

class ProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'productname' => 'required',
            'brandname' => 'required',
            'notes' => 'required'
        ];
        return $rules;
    }
}
