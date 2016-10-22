<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use Purifier;
use Parsedown;

class Post extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * 可填充属性
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'content_origin',
        'sort',
        'published_at',
    ];

    /**
     * 日期
     */
    protected $dates = [
        'published_at', 'created_at', 'updated_at',
    ];

    /**
     * 获取文章所属分类
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * 文章里面的标签
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }
}
