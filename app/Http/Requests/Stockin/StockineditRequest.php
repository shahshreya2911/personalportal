<?php

namespace Vanguard\Http\Requests\Stockin;

use Vanguard\Http\Requests\Request;
use Vanguard\Stockin;

class StockineditRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'stockin_date' => 'required',
            'job_id' => 'required',
            'reason_id' => 'required',
            'note' => 'required',
            'product_id' => 'required'
            
        ];
        return $rules;
    }
}
