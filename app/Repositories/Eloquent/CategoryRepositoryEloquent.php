<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepository;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * 设置哪些字段可以被搜索
     */
    protected $fieldSearchable = [
        'name'  => 'like',
        'sort'  => 'like',
    ];

    /**
     * 关联的 model
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * 启动方法 设置使用 RequestCriteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 重写父类的删除方法
     */
    public function delete($category)
    {
        if (!($category instanceof Category)) {
            $category = $this->find($category);
        }

        if ($category->posts()->exists()) {
            throw new \Exception("请先删除 {$category->name} 下面的文章!");
        }

        $category->delete();

        return $category;
    }

    /**
     * 处理批量删除
     */
    public function batchDelete($request)
    {
        $idString   = $request->input('idstring');
        $idArray    = explode(',', $idString);
        $items      = $this->findWhereIn('id', array_values($idArray));

        foreach ($items as $item) {
            $this->delete($item);
        }
    }

    /**
     * 获取分类列表 在添加文章的时候使用
     */
    public function getCategoryList()
    {
        return $this->model->where('display', '=', 'Y')->get()->pluck('name', 'id');
    }
}
