<?php

namespace Vanguard\Http\Requests\Subcategory;

use Vanguard\Http\Requests\Request;
use Vanguard\Subcategory;

class SubcategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
         
            'name' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'description' => 'required'
        ];
        return $rules;
    }
}
