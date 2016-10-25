<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('user');

        return [
            'username'  => "required|min:4|max:32|unique:users,username,{$id}",
            'email'     => 'email',
        ];
    }

    public function messages()
    {
        return [
            'username.required'     => '请输入用户名!',
            'username.min'          => '用户名最少4个字符!',
            'username.max'          => '用户名最多32个字符!',
            'username.unique'       => '用户名已经存在!',
            'email.email'           => '邮箱地址格式错误!',
        ];
    }
}
