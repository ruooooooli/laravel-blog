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
}
