<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'sort', 'display'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
