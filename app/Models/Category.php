<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * 可填充属性
     */
    protected $fillable = ['name', 'sort', 'display'];

    /**
     * 分类下面的文章
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
