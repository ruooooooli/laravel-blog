<?php

namespace App\Http\Requests;

class CategoryUpdateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('category');

        return [
            'name' => "required|unique:categories,name,{$id}",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请输入分类名称!',
            'name.unique'   => '分类名称已经存在!',
        ];
    }

    public function getFillData()
    {
        return [
            'name'      => $this->input('name'),
            'sort'      => $this->input('sort'),
            'display'   => $this->input('display', 'N'),
        ];
    }
}
