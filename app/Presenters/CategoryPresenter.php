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

    /**
     * 转换分类的 是否显示 名称
     */
    public function showDisplayName($display)
    {
        return ($display == 'Y') ? '<i class="green icon checkmark"></i>' : '<i class="red icon remove"></i>';
    }
}
