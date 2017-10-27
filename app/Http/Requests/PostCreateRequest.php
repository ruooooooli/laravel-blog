<?php

namespace App\Http\Requests;

class PostCreateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:2|max:128|unique:posts,title',
            'category_id' => 'required',
            'markdown-source' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请输入文章标题!',
            'title.min' => '文章标题最少2个字符!',
            'title.max' => '文章标题最长128个字符!',
            'title.unique' => '文章标题已经存在!',
            'category_id.required' => '请选择文章分类!',
            'markdown-source.required' => '请输入文章内容!',
        ];
    }
}
