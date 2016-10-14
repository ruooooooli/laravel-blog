<?php

namespace App\Presenters;

use App\Transformers\PostTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

<<<<<<< HEAD
class PostPresenter extends FractalPresenter
{
=======
/**
 * Class PostPresenter
 *
 * @package namespace App\Presenters;
 */
class PostPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    public function getTransformer()
    {
        return new PostTransformer();
    }
}
