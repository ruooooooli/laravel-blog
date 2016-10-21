<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\TagRepository;

/**
 * 文章控制器
 */
class PostsController extends Controller
{
    /**
     * 文章
     */
    protected $post;

    /**
     * 分类
     */
    protected $category;

    /**
     * 标签
     */
    protected $tag;

    /**
     * 构造方法
     */
    public function __construct(PostRepository $post, CategoryRepository $category, TagRepository $tag)
    {
        $this->post     = $post;
        $this->category = $category;
        $this->tag      = $tag;
    }

    /**
     * 显示文章列表
     */
    public function index(Request $request)
    {
        $key    = $request->input('key', '');
        $posts  = $this->post->getSearchResult($request);

        return view('backend.post.index', compact('posts', 'key'));
    }

    /**
     * 显示添加的页面
     */
    public function create()
    {
        $categories = $this->category->getCategoryList();
        $tags       = $this->tag->getTagList();

        return view('backend.post.create', compact('categories', 'tags'));
    }

    /**
     * 处理添加文章
     */
    public function store(PostCreateRequest $request)
    {
        try {
            $post = $this->post->create($request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文章创建成功!');
    }

    /**
     * 显示编辑页面
     */
    public function edit($id)
    {
        $categories = $this->category->getCategoryList();
        $tags       = $this->tag->getTagList();
        $post       = $this->post->find($id);

        return view('backend.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * 更新文章
     */
    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $post = $this->post->update($id, $request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文章修改成功!');
    }

    /**
     * 删除文章
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->post->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文章删除成功!');
    }

    /**
     * 批量删除文章
     */
    public function batch(Request $request)
    {
        try {
            $this->post->batchDelete($request);
        } catch (\Exception $e) {
            return errorJson();
        }

        return successJson('文章批量删除成功!');
    }
}
