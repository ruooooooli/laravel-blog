<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Repositories\Contracts\TagRepository;

/**
 * 标签控制器
 */
class TagsController extends Controller
{
    /**
     * 标签
     */
    protected $tag;

    /**
     * 构造方法
     */
    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    /**
     * 显示标签列表
     */
    public function index(Request $request)
    {
        $key    = $request->input('key', '');
        $tags   = $this->tag->getSearchResult($request);

        return view('backend.tag.index', compact('tags', 'key'));
    }

    /**
     * 显示添加标签的页面
     */
    public function create()
    {
        return view('backend.tag.create');
    }

    /**
     * 处理创建标签的请求
     */
    public function store(TagCreateRequest $request)
    {
        try {
            $tag = $this->tag->create($request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签添加成功!');
    }

    /**
     * 显示编辑标签的页面
     */
    public function edit($id)
    {
        $tag = $this->tag->find($id);

        return view('backend.tag.edit', compact('tag'));
    }

    /**
     * 处理更新标签的请求
     */
    public function update(TagUpdateRequest $request, $id)
    {
        try {
            $tag = $this->tag->update($request->all(), $id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签更新成功!');
    }

    /**
     * 删除标签
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->tag->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签删除成功!');
    }

    /**
     * 批量删除
     */
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
