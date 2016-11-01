<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use Klaravel\Ntrust\Traits\NtrustUserTrait;

class User extends Authenticatable implements Transformable
{
    use Notifiable, TransformableTrait, NtrustUserTrait;

    protected static $roleProfile = 'user';

    /**
     * 可填充属性
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * 不可填充属性
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 使用的 NtrustUserTrait 里面包含了 can 方法, 导致 Laravel 自带的方法不能使用
     * 在这里重写一下
     */
    public function cant($ability, $arguments = [])
    {
        return !(app(Gate::class)->forUser($this)->check($ability, $arguments));
    }

    /**
     * 时间管理
     */
    protected $dates = [
        'last_login', 'created_at', 'updated_at',
    ];

    /**
     * 用户添加的文章
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
}
