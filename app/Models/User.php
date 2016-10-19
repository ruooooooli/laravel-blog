<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable implements Transformable
{
    use Notifiable, TransformableTrait;

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
