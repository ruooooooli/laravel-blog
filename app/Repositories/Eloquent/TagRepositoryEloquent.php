<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Models\Tag;
use App\Repositories\Contracts\TagRepository;

class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
    /**
     * 设置哪些字段可以被搜索
     */
    protected $fieldSearchable = [
        'name'  => 'like',
        'slug'  => 'like',
    ];

    /**
     * 关联的 model
     */
    public function model()
    {
        return Tag::class;
    }

    /**
     * 启动方法 设置使用 RequestCriteria
     */
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
