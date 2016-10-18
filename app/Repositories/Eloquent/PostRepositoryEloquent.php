<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PostRepository;
use App\Models\Post;
use App\Bridge\Markdown;

class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    public function model()
    {
        return Post::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 获取查询条件
     */
    public function getSearchWhere($request)
    {
        $where = array();
        if ($request->has('key')) {
            $key = $request->input('key', '');
            array_push($where, array('title', 'like', "{$key}"));
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
     * 处理创建文章 重写了父类的方法
     */
    public function create(array $input)
    {
        $array      = array(
            'user_id'       => \Auth::id(),
            'category_id'   => $input['category_id'],
            'title'         => $input['title'],
            'content'       => (new Markdown())->markdownToHtml($input['markdown-source']),
            'content_origin'=> $input['markdown-source'],
            'sort'          => $input['sort'],
            'published_at'  => $input['published_at'],
        );

        return Post::create($array);
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
            $item->delete();
        }
    }
}
