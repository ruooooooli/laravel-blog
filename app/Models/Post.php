<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Parsedown;
use Purifier;

class Post extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    public function category()
    {
      return $this->belongsTo(Category::class);
    }
}
