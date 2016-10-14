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

    public function getSearchWhere($request)
    {
        $where = array();
        if ($request->has('key')) {
            $key = $request->input('key', '');
            array_push($where, array('title', 'like', "{$key}"));
        }

        return $where;
    }

    public function getSearchResult($request)
    {
        $this->applyConditions($this->getSearchWhere($request));

        return $this->orderBy('id', 'desc')->paginate(config('blog.pageSize'));
    }

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
}
