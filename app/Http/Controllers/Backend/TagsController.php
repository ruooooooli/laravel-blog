<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
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

    public function store(TagCreateRequest $request)
    {
        try {
            $tag = $this->repository->create($request->all());
        } catch (ValidatorException $e) {
        }
    }

    public function edit($id)
    {

        $tag = $this->repository->find($id);

        return view('tags.edit', compact('tag'));
    }

    public function update(TagUpdateRequest $request, $id)
    {
        try {
            $tag = $this->repository->update($id, $request->all());
        } catch (ValidatorException $e) {

        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back()->with('message', 'Tag deleted.');
    }
}
