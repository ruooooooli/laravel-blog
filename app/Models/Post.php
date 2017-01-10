<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Purifier;
use Parsedown;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Post extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'content_origin',
        'sort',
        'published_at',
    ];

    protected $dates = ['published_at', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }
}
