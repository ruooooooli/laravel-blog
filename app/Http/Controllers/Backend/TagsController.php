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
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function index(Request $request)
    {
        $key    = $request->input('key', '');
        $tags   = $this->tag->getSearchResult($request);

        return view('backend.tag.index', compact('tags', 'key'));
    }

    public function create()
    {
        return view('backend.tag.create');
    }

    public function store(TagCreateRequest $request)
    {
        try {
            $tag = $this->tag->create($request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签添加成功!');
    }

    public function edit($id)
    {
        $tag = $this->tag->find($id);

        return view('backend.tag.edit', compact('tag'));
    }

    public function update(TagUpdateRequest $request, $id)
    {
        try {
            $tag = $this->tag->update($request->all(), $id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签更新成功!');
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->tag->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签删除成功!');
    }

    public function batch(Request $request)
    {
        try {
            $this->tag->batchDelete($request);
        } catch (\Exception $e) {
            return errorJson();
        }

        return successJson('标签批量删除成功!');
    }
}
