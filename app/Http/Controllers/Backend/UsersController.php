<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Contracts\UserRepository;

class UsersController extends Controller
{
    /**
     * repository
     */
    protected $user;

    /**
     * 构造方法
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * 用户首页
     */
    public function index(Request $request)
    {
        $key    = $request->input('key', '');
        $users  = $this->user->getSearchResult($request);

        return view('backend.user.index', compact('users', 'key'));
    }

    /**
     * 显示添加用户的页面
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * 处理添加请求
     */
    public function store(UserCreateRequest $request)
    {
        try {
            $user = $this->user->create($request->all());
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('用户添加成功!');
    }

    /**
     * 显示编辑页面
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('backend.user.edit', compact('user'));
    }

    /**
     * 处理更新请求
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = $this->user->update($request->all(), $id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('用户更新成功!');
    }

    /**
     * 处理删除
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->user->delete($id);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('用户删除成功!');
    }

    /**
     * 处理批量删除请求
     */
    public function batch(Request $request)
    {
        try {
            $this->user->batchDelete($request);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('批量删除成功!');
    }
}
