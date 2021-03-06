<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CategoryRepository;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    protected $fieldSearchable = [
        'name' => 'like',
        'sort' => 'like',
    ];

    public function model()
    {
        return Category::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function delete($category)
    {
        if (! ($category instanceof Category)) {
            $category = $this->find($category);
        }

        if ($category->posts()->exists()) {
            throw new Exception("请先删除 {$category->name} 下面的文章!");
        }

        $category->delete();

        return $category;
    }

    public function batchDelete($request)
    {
        $items = $this->findWhereIn('id', array_values(
            explode(',', $request->input('idstring'))
        ));

        foreach ($items as $item) {
            $this->delete($item);
        }
    }

    public function getCategoryList()
    {
        return $this->model->where('display', '=', 'Y')->get()->pluck('name', 'id');
    }
}
