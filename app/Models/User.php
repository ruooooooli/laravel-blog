<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable implements Transformable
{
    use Notifiable, TransformableTrait;

    protected $fillable = ['username', 'email', 'password'];
    protected $hidden   = ['password', 'remember_token'];
    protected $dates    = ['last_login', 'created_at', 'updated_at'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
}
