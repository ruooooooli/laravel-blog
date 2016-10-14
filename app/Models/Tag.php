<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Tag extends Model implements Transformable
{
    use TransformableTrait;

<<<<<<< HEAD
    protected $fillable = ['name', 'slug', 'description'];
=======
    protected $fillable = [];

>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
}
