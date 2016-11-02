<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;

class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * 设置哪些字段可以被搜索
     */
    protected $fieldSearchable = [
        'name'          => 'like',
        'display_name'  => 'like',
    ];

    /**
     * 关联的 model
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * 启动方法 设置使用 RequestCriteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 重写父类的删除方法
     */
    public function delete($role)
    {
        if (!($role instanceof Role)) {
            $role = $this->find($role);
        }

        if ($role->users()->exists()) {
            throw new \Exception("请先删除 {$role->name} 下面的用户!");
        }

        if ($role->perms()->exists()) {
            throw new \Exception("请先删除 {$role->name} 下面的权限!");
        }

        $role->delete();

        return $role;
    }

    /**
     * 处理批量删除
     */
    public function batchDelete($request)
    {
        $idString   = $request->input('idstring');
        $idArray    = explode(',', $idString);
        $items      = $this->findWhereIn('id', array_values($idArray));

        foreach ($items as $item) {
            $this->delete($item);
        }
    }
}
