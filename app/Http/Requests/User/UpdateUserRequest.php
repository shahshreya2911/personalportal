<?php

namespace Vanguard\Http\Requests\User;

use Illuminate\Validation\Rule;
use Vanguard\Http\Requests\Request;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\User;

class UpdateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();

        return [
            
            'username' => 'nullable|unique:users,username,' . $user->id,
            'password' => 'min:6|confirmed',
            
            'role_id' => 'exists:roles,id',
            
            'status' => Rule::in(array_keys(UserStatus::lists()))
        ];
    }
}
