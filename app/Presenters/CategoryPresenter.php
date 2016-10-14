<?php

namespace App\Presenters;

use App\Transformers\CategoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class CategoryPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new CategoryTransformer();
    }

    public function showDisplayName($display)
    {
        return ($display == 'Y') ? '<i class="green icon checkmark"></i>' : '<i class="red icon remove"></i>';
    }
}
