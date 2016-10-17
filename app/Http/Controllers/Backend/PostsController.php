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
        $key    = $request->input('key', '');
        $posts  = $this->post->getSearchResult($request);

        return view('backend.post.index', compact('posts', 'key'));
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

        return successJson('文章创建成功!');
    }

    public function edit($id)
    {
        $post = $this->post->find($id);

        return view('posts.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $post = $this->post->update($id, $request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文章修改成功!');
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->post->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文章删除成功!');
    }

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
