<?php

namespace App\Http\Requests;

class UserCreateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username'  => 'required|min:4|max:32|unique:users,username',
            'email'     => 'email',
            'password'  => 'required|min:6|max:32|confirmed',
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
            'password.required'     => '请输入密码!',
            'password.min'          => '密码最少6个字符!',
            'password.max'          => '密码最多32个字符!',
            'password.confirmed'    => '请保持两次输入的密码一致!',
        ];
    }
}
