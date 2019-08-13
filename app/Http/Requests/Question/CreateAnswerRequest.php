<?php

namespace Vanguard\Http\Requests\Question;

use Vanguard\Http\Requests\Request;
use Vanguard\Question;

class CreateAnswerRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'answer_id' => 'required',
        ];
        return $rules;
    }
}
