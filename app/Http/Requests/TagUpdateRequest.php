<?php

namespace App\Http\Requests;

class TagUpdateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

     public function rules()
     {
         $id = $this->route('tag');

         return [
             'name' => "required|min:2|max:32|unique:tags,name,{$id}",
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
