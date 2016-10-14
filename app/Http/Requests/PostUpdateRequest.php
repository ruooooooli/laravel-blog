<?php

namespace App\Http\Requests;

class PostUpdateRequest extends Request
{
<<<<<<< HEAD
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('post');

        return [
            'title'             => "required|min:2|max:128|unique:posts,title,{$id}",
            'category_id'       => 'required',
            'markdown-source'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => '请输入文章标题!',
            'title.min'                 => '文章标题最少2个字符!',
            'title.max'                 => '文章标题最长128个字符!',
            'title.unique'              => '文章标题已经存在!',
            'category_id.required'      => '请选择文章分类!',
            'markdown-source.required'  => '请输入文章内容!',
=======
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
        ];
    }
}
