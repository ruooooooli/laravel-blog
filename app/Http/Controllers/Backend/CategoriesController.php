<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Contracts\CategoryRepository;
=======

use App\Http\Requests;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Contracts\CategoryRepository;
use App\Http\Controllers\Controller;
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4

class CategoriesController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $key        = $request->input('key', '');
        $categories = $this->repository->getSearchResult($request);

        return view('backend.category.index', compact('categories', 'key'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        try {
            $category = $this->repository->create($request->getFillData());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('分类添加成功!');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);

        return view('backend.category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $category = $this->repository->update($request->getFillData(), $id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('分类修改成功!');
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->repository->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('分类删除成功!');
    }

    public function batch(Request $request)
    {
        try {
            $this->repository->batchDelete($request);
        } catch (\Exception $e) {
            return errorJson();
        }

        return successJson('分类批量删除成功!');
    }
}
