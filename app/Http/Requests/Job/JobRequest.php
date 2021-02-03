<?php

namespace Vanguard\Http\Requests\Job;

use Vanguard\Http\Requests\Request;
use Vanguard\Job;

class JobRequest extends Request
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
            'jobnum' => 'required',
            'starting_date' => 'required',
            'end_date' => 'required',
            'location' => 'required',
            'description' => 'required',
            'note' => 'required',
            'product_id' => 'required',
            'product_quantity' => 'required'
        ];
        return $rules;
    }
}
