<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use Auth;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Bridge\Markdown;
use App\Repositories\Contracts\PostRepository;

class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * 设置哪些字段可以被搜索
     */
    protected $fieldSearchable = [
        'title' => 'like',
        'sort'  => 'like',
    ];

    /**
     * 关联的 model
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * 启动方法 设置使用 RequestCriteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 处理创建文章 重写了父类的方法
     */
    public function create(array $input)
    {
        $tags           = explode(',', $input['tags']);
        $tag            = Tag::whereIn('id', $tags)->get();
        $published_at   = Carbon::createFromFormat('Y-m-d', $input['published_at'])->toDateTimeString();
        $array          = array(
            'user_id'       => Auth::id(),
            'category_id'   => $input['category_id'],
            'title'         => $input['title'],
            'content'       => (new Markdown())->markdownToHtml($input['markdown-source']),
            'content_origin'=> $input['markdown-source'],
            'sort'          => $input['sort'] ?: 255,
            'published_at'  => $published_at,
        );

        $post = Post::create($array);
        $post->tags()->attach($tags);

        return $post;
    }

    /**
     * 处理创建文章 重写了父类的方法
     */
    public function update(array $input, $id)
    {
        $post = $this->find($id);

        if (Auth::user()->cant('update', $post)) {
            throw new \Exception('您当前没有权限更新这篇文章!');
        }

        $tags           = explode(',', $input['tags']);
        $tag            = Tag::whereIn('id', $tags)->get();
        $published_at   = Carbon::createFromFormat('Y-m-d', $input['published_at'])->toDateTimeString();
        $array          = array(
            'user_id'       => Auth::id(),
            'category_id'   => $input['category_id'],
            'title'         => $input['title'],
            'content'       => (new Markdown())->markdownToHtml($input['markdown-source']),
            'content_origin'=> $input['markdown-source'],
            'sort'          => $input['sort'] ?: 255,
            'published_at'  => $published_at,
        );

        $post->update($array);
        $post->tags()->sync($tags);

        return $post;
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
     * 处理删除文章
     */
    public function delete($post)
    {
        if (!($post instanceof Post)) {
            $post = $this->find($post);
        }

        if (Auth::user()->cant('delete', $post)) {
            throw new \Exception('您当前没有权限删除这篇文章!');
        }

        $post->delete();

        return $post;
    }
}
