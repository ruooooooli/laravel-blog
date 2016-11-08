<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepository;

/**
 * 角色控制器
 */
class RolesController extends Controller
{
    /**
     * repository
     */
    protected $role;

    /**
     * 构造方法
     */
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    /**
     * 角色列表
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $roles  = $this->role->paginate(config('blog.pageSize'));

        return view('backend.role.index', compact('search', 'roles'));
    }

    /**
     * 添加角色
     */
    public function create()
    {
        return view('backend.role.create');
    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
