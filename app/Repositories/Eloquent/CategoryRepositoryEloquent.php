<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CategoryRepository;
use App\Models\Category;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    public function model()
    {
        return Category::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function delete($id)
    {
        $category = $this->find($id);

        if ($category->posts()->exists()) {
            throw new Exception('请先删除分类下面的文章!');
        }

        return $category->delete();
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

    public function getCategoryList()
    {
        return $this->model->where('display', '=', 'Y')->get()->pluck('name', 'id');
    }
}
