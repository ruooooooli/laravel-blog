<?php

namespace App\Presenters;

use App\Transformers\TagTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class TagPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new TagTransformer();
    }
}
