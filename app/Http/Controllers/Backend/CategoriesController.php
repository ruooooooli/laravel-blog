<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Contracts\CategoryRepository;

class CategoriesController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $categories = $this->category->paginate(config('blog.pageSize'));

        return view('backend.category.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        try {
            $category = $this->category->create($request->getFillData());
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("分类 : {$category->name} 添加成功!");
    }

    public function edit($id)
    {
        $category = $this->category->find($id);

        return view('backend.category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $category = $this->category->update($request->getFillData(), $id);
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("分类 : {$category->name} 修改成功!");
    }

    public function destroy($id)
    {
        try {
            $category = $this->category->delete($id);
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("分类 : {$category->name} 删除成功!");
    }

    public function batch(Request $request)
    {
        try {
            $this->category->batchDelete($request);
        } catch (Exception $e) {
            return errorJson();
        }

        return successJson('批量删除成功!');
    }
}
