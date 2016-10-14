<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TagRepository;
use App\Models\Tag;
<<<<<<< HEAD
=======
use App\Validators\TagValidator;
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4

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
<<<<<<< HEAD

        return $this->orderBy('id', 'desc')->paginate(config('blog.pageSize'));
    }

    public function batchDelete($request)
    {
        $idString   = $request->input('idstring');
        $idArray    = explode(',', $idString);
        $items      = $this->findWhereIn('id', array_values($idArray));

        foreach ($items as $item) {
            if ($item->posts()->exists()) {
                throw new Exception("请先删除 {$item->name} 下面的文章!");
            }

            $item->delete();
        }
    }
=======
        return $this->orderBy('id', 'desc')->paginate(config('blog.pageSize'));
    }
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
}
