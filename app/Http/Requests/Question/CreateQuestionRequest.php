<?php

namespace Vanguard\Http\Requests\Question;

use Vanguard\Http\Requests\Request;
use Vanguard\Question;

class CreateQuestionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'sentence' => 'required',
            'level' => 'required',
            'active' => 'required'
        ];
        return $rules;
    }
}
