<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Http\Requests;
=======

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
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

<<<<<<< HEAD
    public function create()
    {
        return view('backend.tag.create');
    }

=======
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    public function store(TagCreateRequest $request)
    {
        try {
            $tag = $this->repository->create($request->all());
<<<<<<< HEAD
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签添加成功!');
=======
        } catch (ValidatorException $e) {
        }
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    }

    public function edit($id)
    {
<<<<<<< HEAD
        $tag = $this->repository->find($id);

        return view('backend.tag.edit', compact('tag'));
=======

        $tag = $this->repository->find($id);

        return view('tags.edit', compact('tag'));
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    }

    public function update(TagUpdateRequest $request, $id)
    {
        try {
<<<<<<< HEAD
            $tag = $this->repository->update($request->all(), $id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签更新成功!');
=======
            $tag = $this->repository->update($id, $request->all());
        } catch (ValidatorException $e) {

        }
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    }

    public function destroy($id)
    {
<<<<<<< HEAD
        try {
            $deleted = $this->repository->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('标签删除成功!');
=======
        $deleted = $this->repository->delete($id);
        return redirect()->back()->with('message', 'Tag deleted.');
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    }
}
