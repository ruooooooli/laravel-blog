@extends('layout.backend.master')

@section('title', '文章列表')

@section('content')

@include('layout.backend.table_search', ['search' => 'backend::post.index', 'delete' => route('backend::post.batch')])

<table class="ui celled table center aligned list">
    <thead>
        <tr>
            <th>
                <div class="ui master checkbox">
                    <input type="checkbox">
                </div>
            </th>
            <th>文章标题</th>
            <th>发布时间</th>
            <th>阅读数</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(count($posts))
            @foreach($posts as $key => $value)
                <tr>
                    <td>
                        <div class="ui child checkbox" data-id="{{ $value->id }}">
                            <input type="checkbox" class="select-checkbox">
                        </div>
                    </td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->published_at->toDateString() }}</td>
                    <td>{{ $value->view_count }}</td>
                    <td>{{ $value->sort }}</td>
                    <td>
                        <div class="ui buttons">
                            <a class="ui green icon button" href="{{ route('backend::post.edit', $value->id) }}">
                                <i class="write arrow icon"></i>
                            </a>
                            <a class="ui red icon button delete-post-btn" data-url="{{ route('backend::post.destroy', $value->id) }}">
                                <i class="remove arrow icon"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            @include('layout.backend.table_noresult', ['colspan' => 6])
        @endif
    </tbody>
    <tfoot>
        @include('layout.backend.table_paginate', ['value' => $posts, 'colspan' => 6])
    </tfoot>
</table>
@endsection
