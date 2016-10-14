<?php

namespace App\Presenters;

use App\Transformers\TagTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

<<<<<<< HEAD
class TagPresenter extends FractalPresenter
{
=======
/**
 * Class TagPresenter
 *
 * @package namespace App\Presenters;
 */
class TagPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    public function getTransformer()
    {
        return new TagTransformer();
    }
}
