<?php

namespace Vanguard\Http\Requests\Zone;

use Vanguard\Http\Requests\Request;
use Vanguard\Zone;

class ZoneRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'warehouse' => 'required',
            'room' => 'required',
            'shelf' => 'required'
        ];
        return $rules;
    }
}
