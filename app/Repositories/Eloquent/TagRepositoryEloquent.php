<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Models\Tag;
use App\Repositories\Contracts\TagRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
    protected $fieldSearchable = [
        'name'  => 'like',
        'slug'  => 'like',
    ];

    public function model()
    {
        return Tag::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getTagList()
    {
        return $this->model->get();
    }

    public function batchDelete($request)
    {
        $idString = $request->input('idstring');
        $idArray = explode(',', $idString);
        $items = $this->findWhereIn('id', array_values($idArray));

        foreach ($items as $item) {
            $this->delete($item);
        }
    }

    public function delete($tag)
    {
        if (! ($tag instanceof Tag)) {
            $tag = $this->find($tag);
        }

        if ($tag->posts()->exists()) {
            throw new Exception("请先删除 {$item->name} 下面的文章!");
        }

        $tag->delete();

        return $tag;
    }
}
