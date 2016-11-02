<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepository;


class RolesController extends Controller
{
    protected $role;

    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $roles  = $this->role->paginate(config('blog.pageSize'));

        return view('backend.role.index', compact('search', 'roles'));
    }

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
