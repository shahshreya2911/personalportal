<?php

namespace Vanguard\Http\Requests\User;

use Vanguard\Http\Requests\Request;
use Vanguard\User;

class CreateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
           
            'username' => 'nullable|unique:users,username',
            'password' => 'required|min:6|confirmed',
            
            'role_id' => 'required|exists:roles,id',
        ];

       /* if ($this->get('country_id')) {
            $rules += ['country_id' => 'exists:countries,id'];
        }*/

        return $rules;
    }
}
