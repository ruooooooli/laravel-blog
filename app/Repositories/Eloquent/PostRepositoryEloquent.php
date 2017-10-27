<?php

namespace App\Repositories\Eloquent;

use Auth;
use Exception;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Bridge\Markdown;
use App\Repositories\Contracts\PostRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    protected $fieldSearchable = [
        'title' => 'like',
        'sort' => 'like',
    ];

    public function model()
    {
        return Post::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $input)
    {
        $tags = explode(',', $input['tags']);
        $tag = Tag::whereIn('id', $tags)->get();
        $published_at = Carbon::createFromFormat('Y-m-d', $input['published_at'])->toDateTimeString();

        $post = Post::create([
            'user_id' => Auth::id(),
            'category_id' => $input['category_id'],
            'title' => $input['title'],
            'content' => (new Markdown())->markdownToHtml($input['markdown-source']),
            'content_origin' => $input['markdown-source'],
            'sort' => $input['sort'] ?: 255,
            'published_at' => $published_at,
        ]);

        $post->tags()->attach($tags);

        return $post;
    }

    public function update(array $input, $id)
    {
        $post = $this->find($id);

        if (Auth::user()->cant('update', $post)) {
            throw new Exception('您当前没有权限更新这篇文章!');
        }

        $tags = explode(',', $input['tags']);
        $tag = Tag::whereIn('id', $tags)->get();
        $published_at = Carbon::createFromFormat('Y-m-d', $input['published_at'])->toDateTimeString();
        $array = array(
            'user_id' => Auth::id(),
            'category_id' => $input['category_id'],
            'title' => $input['title'],
            'content' => (new Markdown())->markdownToHtml($input['markdown-source']),
            'content_origin'=> $input['markdown-source'],
            'sort' => $input['sort'] ?: 255,
            'published_at' => $published_at,
        );

        $post->update($array);
        $post->tags()->sync($tags);

        return $post;
    }

    public function batchDelete($request)
    {
        $idString = $request->input('idstring');
        $idArray = explode(',', $idString);
        $items = $this->findWhereIn('id', array_values($idArray));

        foreach ($items as $item) {
            $this->delete($item);
        }
    }

    public function delete($post)
    {
        if (! ($post instanceof Post)) {
            $post = $this->find($post);
        }

        if (Auth::user()->cant('delete', $post)) {
            throw new Exception('您当前没有权限删除这篇文章!');
        }

        $post->delete();

        return $post;
    }
}
