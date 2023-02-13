<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HouseRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'            => 'sometimes|required|exists:App\Models\House,id',
            'name'          => 'sometimes|required|max:50',
            'ward_code'     => 'sometimes|required|exists:App\Models\Address\Ward,code',
            'category_id'   => 'sometimes|required|exists:App\Models\Category,id'
        ];
    }
}
