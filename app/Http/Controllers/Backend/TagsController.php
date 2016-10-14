<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Repositories\Contracts\TagRepository;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    protected $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $key    = $request->input('key', '');
        $tags   = $this->repository->getSearchResult($request);

        return view('backend.tag.index', compact('tags', 'key'));
    }

    public function create()
    {
        return view('backend.tag.create');
    }

    public function store(TagCreateRequest $request)
    {
        try {
            $tag = $this->repository->create($request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签添加成功!');
    }

    public function edit($id)
    {
        $tag = $this->repository->find($id);

        return view('backend.tag.edit', compact('tag'));
    }

    public function update(TagUpdateRequest $request, $id)
    {
        try {
            $tag = $this->repository->update($request->all(), $id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签更新成功!');
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->repository->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签删除成功!');
    }
}
