<?php

namespace Vanguard\Http\Requests\Stockout;

use Vanguard\Http\Requests\Request;
use Vanguard\Stockin;

class StockoutRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'stockout_date' => 'required',
            'job_id' => 'required',
            'reason_id' => 'required',
            'note' => 'required',
            'product_id' => 'required',
            'product_quantity' => 'required'
        ];
        return $rules;
    }
}
