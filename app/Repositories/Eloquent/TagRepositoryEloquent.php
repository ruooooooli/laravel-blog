<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Models\Tag;
use App\Repositories\Contracts\TagRepository;

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

    /**
     * 获取标签列表 在添加文章的时候使用
     */
    public function getTagList()
    {
        return $this->model->get();
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
            array_push($where, array('slug', 'like', "%{$key}%"));
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
     * 处理删除
     */
    public function delete($tag)
    {
        if (!($tag instanceof Tag)) {
            $tag = $this->find($tag);
        }

        if ($tag->posts()->exists()) {
            throw new \Exception("请先删除 {$item->name} 下面的文章!");
        }

        $tag->delete();

        return $tag;
    }
}
