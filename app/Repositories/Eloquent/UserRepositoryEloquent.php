<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Models\User;
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
        $user = $this->find($id);

        if ($this->checkPassword($input)) {
            $user->password = bcrypt($input['password']);
        }

        $user->username = $input['username'];
        $user->email    = $input['email'];

        return $user->update();
    }

    /**
     * 默认更新用户可以不用填写密码 如果填写了请保持一致
     */
    private function checkPassword($input)
    {
        $password           = $input['password'];
        $passwordConfirm    = $input['password_confirmation'];

        if (!empty($password)) {
            if (mb_strlen($password) < 6) {
                throw new \Exception('密码最少6个字符!');
            }

            if (mb_strlen($password) > 32) {
                throw new \Exception('密码最多32个字符!');
            }

            if ($password !== $passwordConfirm) {
                throw new \Exception('请保持两次输入的密码一致!');
            }

            return true;
        }

        return false;
    }

    /**
     * 获取查询条件
     */
    public function getSearchWhere($request)
    {
        $where = array();

        if ($request->has('key')) {
            $key = $request->input('key');

            array_push($where, array('username', 'like', "%{$key}%"));
            array_push($where, array('email', 'like', "%{$key}%"));
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
            $user = $this->find($user);
        }

        if ($user->posts()->exists()) {
            throw new \Exception('请先删除用户下面的文章!');
        }

        return $user->delete();
    }
}
