<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'user_id' => 'sometimes|required|exists:App\Models\User,id',
            'ward_code' => 'sometimes|required|exists:App\Models\Address\Ward,code'
        ];
    }
}
