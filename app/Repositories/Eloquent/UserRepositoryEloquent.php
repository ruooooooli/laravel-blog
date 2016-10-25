<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Models\User;
use App\Validators\UserValidator;
use App\Repositories\Contracts\UserRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 创建
     */
    public function create(array $input)
    {
        $input['password'] = bcrypt($input['password']);

        return User::create($input);
    }

    /**
     * 更新
     */
    public function update(array $input, $id)
    {
        $user = User::findOrFail($id);

        $input['password'] = bcrypt($input['password']);

        return $user->update($input);
    }

    /**
     * 获取查询条件
     */
    public function getSearchWhere($request)
    {
        $where = array();

        if ($request->has('key')) {
            $key = $request->input('key');
            array_push($where, array('name', 'like', "%{$key}%"));
        }

        return $where;
    }

    /**
     * 获取搜索结果
     */
    public function getSearchResult($request)
    {
        $this->applyConditions($this->getSearchWhere($request));

        return $this->orderBy('id', 'desc')->paginate(config('blog.pageSize'));
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

    /**
     * 处理删除
     */
    public function delete($user)
    {
        if (!($user instanceof User)) {
            $user = User::findOrFail($user);
        }

        // 判断不能删除的情况

        return $user->delete();
    }
}
