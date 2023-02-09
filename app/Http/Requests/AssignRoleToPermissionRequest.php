<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AssignRoleToPermissionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role_id'           => 'required|exists:App\Models\Role,id',
            'permission_id.*'   => 'required|exists:App\Models\Permission,id',
        ];
    }
}
