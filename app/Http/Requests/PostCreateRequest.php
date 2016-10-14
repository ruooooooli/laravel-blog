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
<<<<<<< HEAD
        return [
            'title'             => 'required|min:2|max:128|unique:posts,title',
            'category_id'       => 'required',
            'markdown-source'   => 'required'
        ];
=======
        return array(
            'title'             => 'required|min:2|max:128|unique:posts,title',
            'category_id'       => 'required',
            'markdown-source'   => 'required'
        );
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    }

    public function messages()
    {
<<<<<<< HEAD
        return [
=======
        return array(
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
            'title.required'            => '请输入文章标题!',
            'title.min'                 => '文章标题最少2个字符!',
            'title.max'                 => '文章标题最长128个字符!',
            'title.unique'              => '文章标题已经存在!',
            'category_id.required'      => '请选择文章分类!',
            'markdown-source.required'  => '请输入文章内容!',
<<<<<<< HEAD
        ];
=======
        );
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    }
}
