<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AssignRoleToUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id'       => 'required|exists:App\Models\User,id',
            'role_id'       => 'required|exists:App\Models\Role,id',
        ];
    }
}
