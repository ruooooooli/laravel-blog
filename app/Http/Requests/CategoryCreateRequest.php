<?php

namespace App\Http\Requests;

class CategoryCreateRequest extends Request
{
<<<<<<< HEAD
=======
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    public function authorize()
    {
        return true;
    }

<<<<<<< HEAD
=======
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
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
