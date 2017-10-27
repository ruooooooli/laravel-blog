<?php

namespace App\Presenters;

use App\Transformers\LogTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class LogPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new LogTransformer();
    }
}
