<?php

namespace Vanguard\Http\Requests\Question;

use Vanguard\Http\Requests\Request;
use Vanguard\Question;

class CreateChoiceRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'fk_question_id' => 'required',
            'answer' => 'required',
            'active' => 'required'
        ];
        return $rules;
    }
}
