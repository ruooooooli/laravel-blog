<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable implements Transformable
{
<<<<<<< HEAD
    use Notifiable, TransformableTrait;

=======
    use Notifiable;
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    protected $fillable = [
        'username', 'email', 'password',
    ];

<<<<<<< HEAD
=======
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
<<<<<<< HEAD
        'last_login', 'created_at', 'updated_at',
=======
        'last_login', 'created_at', 'updated_at'
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    ];
}
