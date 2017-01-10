<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\Contracts\TagRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\CategoryRepository;

class PostsController extends Controller
{
    protected $post;
    protected $category;
    protected $tag;

    public function __construct(PostRepository $post, CategoryRepository $category, TagRepository $tag)
    {
        $this->post     = $post;
        $this->category = $category;
        $this->tag      = $tag;
    }

    public function index(Request $request)
    {
        $search     = $request->input('search', '');
        $posts      = $this->post->paginate(config('blog.pageSize'));

        return view('backend.post.index', compact('posts', 'search'));
    }

    public function create()
    {
        $categories = $this->category->getCategoryList();
        $tags       = $this->tag->getTagList();

        return view('backend.post.create', compact('categories', 'tags'));
    }

    public function store(PostCreateRequest $request)
    {
        try {
            $post = $this->post->create($request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("文章 : {$post->title} 创建成功!");
    }

    public function edit($id)
    {
        $categories = $this->category->getCategoryList();
        $tags       = $this->tag->getTagList();
        $post       = $this->post->find($id);

        return view('backend.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $post = $this->post->update($request->all(), $id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("文章 : {$post->title} 修改成功!");
    }

    public function destroy($id)
    {
        try {
            $post = $this->post->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("文章 : {$post->title} 删除成功!");
    }

    public function batch(Request $request)
    {
        try {
            $this->post->batchDelete($request);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('批量删除成功!');
    }
}
