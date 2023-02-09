<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_vi'           => 'required|max:30|unique:categories,name_vi',
            'name_en'           => 'required|max:30|unique:categories,name_en',
            'description_vi'    => 'max:255',
            'description_en'    => 'max:255'
        ];
    }
}
