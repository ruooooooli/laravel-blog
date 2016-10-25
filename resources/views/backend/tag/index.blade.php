@extends('layout.backend.master')

@section('title', '标签列表')

@section('content')

@include('layout.backend.table_search', ['search' => 'backend::tag.index', 'delete' => route('backend::tag.batch')])

<table class="ui celled table center aligned list">
    <thead>
        <tr>
            <th>
                <div class="ui master checkbox">
                    <input type="checkbox">
                </div>
            </th>
            <th>标签名称</th>
            <th>slug</th>
            <th>文章数量</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(count($tags))
            @foreach($tags as $key => $value)
                <tr>
                    <td>
                        <div class="ui child checkbox" data-id="{{ $value->id }}">
                            <input type="checkbox" class="select-checkbox">
                        </div>
                    </td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->slug }}</td>
                    <td>{{ $value->slug }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                        <div class="ui buttons">
                            <a class="ui green icon button" href="{{ route('backend::tag.edit', $value->id) }}">
                                <i class="write arrow icon"></i>
                            </a>
                            <a class="ui red icon button delete-btn" data-url="{{ route('backend::tag.destroy', $value->id) }}">
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
        @include('layout.backend.table_paginate', ['value' => $tags, 'colspan' => 6])
    </tfoot>
</table>
@endsection
