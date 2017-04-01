<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Repositories\Contracts\TagRepository;

class TagsController extends Controller
{
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function index(Request $request)
    {
        $search     = $request->input('search', '');
        $tags       = $this->tag->paginate(config('blog.pageSize'));

        return view('backend.tag.index', compact('tags', 'search'));
    }

    public function create()
    {
        return view('backend.tag.create');
    }

    public function store(TagCreateRequest $request)
    {
        try {
            $tag = $this->tag->create($request->all());
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("标签 : {$tag->name} 添加成功!");
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
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("标签 : {$tag->name} 更新成功!");
    }

    public function destroy($id)
    {
        try {
            $tag = $this->tag->delete($id);
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("标签 : {$tag->name} 删除成功!");
    }

    public function batch(Request $request)
    {
        try {
            $this->tag->batchDelete($request);
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('批量删除成功!');
    }
}
