<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
{
<<<<<<< HEAD
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
        ];
    }
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
}
