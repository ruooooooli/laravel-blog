<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TagRepository;
use App\Models\Tag;
use App\Validators\TagValidator;

class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
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
        return $this->model->get()->pluck('name', 'id');
    }

    public function getSearchWhere($request)
    {
        $where = array();
        if ($request->has('key')) {
            $key = $request->input('key');
            array_push($where, array('name', 'like', "%{$key}%"));
        }

        return $where;
    }

    public function getSearchResult($request)
    {
        $this->applyConditions($this->getSearchWhere($request));
        return $this->orderBy('id', 'desc')->paginate(config('blog.pageSize'));
    }
}
