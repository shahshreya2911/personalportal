<?php

namespace Vanguard\Http\Requests\Stockout;

use Vanguard\Http\Requests\Request;
use Vanguard\Stockout;

class StockouteditRequest extends Request
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
            'product_id' => 'required'
            
        ];
        return $rules;
    }
}
