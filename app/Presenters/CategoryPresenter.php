<?php

namespace App\Presenters;

use App\Transformers\CategoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

<<<<<<< HEAD
class CategoryPresenter extends FractalPresenter
{
=======
/**
 * Class CategoryPresenter
 *
 * @package namespace App\Presenters;
 */
class CategoryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    public function getTransformer()
    {
        return new CategoryTransformer();
    }

    public function showDisplayName($display)
    {
        return ($display == 'Y') ? '<i class="green icon checkmark"></i>' : '<i class="red icon remove"></i>';
    }
}
