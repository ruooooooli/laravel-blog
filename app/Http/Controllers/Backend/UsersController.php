<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Contracts\UserRepository;

class UsersController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $users = $this->user->paginate(config('blog.pageSize'));

        return view('backend.user.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(UserCreateRequest $request)
    {
        try {
            $user = $this->user->create($request->all());
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("用户 : {$user->username} 添加成功!");
    }

    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('backend.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = $this->user->update($request->all(), $id);
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("用户 : {$user->username} 更新成功!");
    }

    public function destroy($id)
    {
        try {
            $user = $this->user->delete($id);
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson("用户 : {$user->username} 删除成功!");
    }

    public function batch(Request $request)
    {
        try {
            $this->user->batchDelete($request);
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('批量删除成功!');
    }
}
