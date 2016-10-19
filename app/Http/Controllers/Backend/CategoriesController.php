<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Contracts\CategoryRepository;

/**
 * 分类控制器
 */
class CategoriesController extends Controller
{
    /**
     * 分类
     */
    protected $category;

    /**
     * 构造方法
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * 分类列表
     */
    public function index(Request $request)
    {
        $key        = $request->input('key', '');
        $categories = $this->category->getSearchResult($request);

        return view('backend.category.index', compact('categories', 'key'));
    }

    /**
     * 显示添加分类的页面
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * 处理添加分类
     */
    public function store(CategoryCreateRequest $request)
    {
        try {
            $category = $this->category->create($request->getFillData());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('分类添加成功!');
    }

    /**
     * 显示编辑分类的页面
     */
    public function edit($id)
    {
        $category = $this->category->find($id);

        return view('backend.category.edit', compact('category'));
    }

    /**
     * 处理更新分类
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $category = $this->category->update($request->getFillData(), $id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('分类修改成功!');
    }

    /**
     * 删除分类
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->category->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('分类删除成功!');
    }

    /**
     * 批量删除
     */
    public function batch(Request $request)
    {
        try {
            $this->category->batchDelete($request);
        } catch (\Exception $e) {
            return errorJson();
        }

        return successJson('分类批量删除成功!');
    }
}
