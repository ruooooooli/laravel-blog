<?php

namespace App\Presenters;

use App\Transformers\PostTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class PostPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new PostTransformer();
    }

    public function showTagsIdString($post)
    {
        return $post->tags()->pluck('id')->implode(',');
    }
}
