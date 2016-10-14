<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Http\Requests;
use App\Http\Controllers\Controller;
=======

use App\Http\Requests;
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\TagRepository;
<<<<<<< HEAD
=======
use App\Http\Controllers\Controller;
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4

class PostsController extends Controller
{
    protected $repository;
<<<<<<< HEAD

    protected $category;

=======
    protected $category;
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    protected $tag;

    public function __construct(PostRepository $repository, CategoryRepository $category, TagRepository $tag)
    {
        $this->repository   = $repository;
        $this->category     = $category;
        $this->tag          = $tag;
    }

    public function index(Request $request)
    {
        $key    = $request->input('key', '');
        $posts  = $this->repository->getSearchResult($request);

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
            $post = $this->repository->create($request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文章创建成功!');
    }

    public function edit($id)
    {
        $post = $this->repository->find($id);

        return view('posts.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $post = $this->repository->update($id, $request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文章修改成功!');
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
    }
}
