<?php

namespace App\Http\Requests;

class CategoryCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name',
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
