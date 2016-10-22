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

    /**
     * 重写父类的删除方法
     */
    public function delete($id)
    {
        $category = $this->find($id);

        if ($category->posts()->exists()) {
            throw new \Exception('请先删除分类下面的文章!');
        }

        return $category->delete();
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
            if ($item->posts()->exists()) {
                throw new \Exception("请先删除 {$item->name} 下面的文章!");
            }

            $item->delete();
        }
    }

    /**
     * 获取查询条件
     */
    public function getSearchWhere($request)
    {
        $where = array();
        if ($request->has('key')) {
            $key = $request->input('key');
            array_push($where, array('name', 'like', "%{$key}%"));
        }

        return $where;
    }

    /**
     * 获取搜索结果
     */
    public function getSearchResult($request)
    {
        $this->applyConditions($this->getSearchWhere($request));

        return $this->orderBy('id', 'desc')->paginate(config('blog.pageSize'));
    }

    /**
     * 获取分类列表 在添加文章的时候使用
     */
    public function getCategoryList()
    {
        return $this->model->where('display', '=', 'Y')->get()->pluck('name', 'id');
    }
}
