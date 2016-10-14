<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:32|unique:tags,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请输入标签的名称!',
            'name.min'      => '标签名称最小2个字符!',
            'name.max'      => '标签名称最大32个字符!',
            'name.unique'   => '标签名称已经存在!',
        ];
    }
}
