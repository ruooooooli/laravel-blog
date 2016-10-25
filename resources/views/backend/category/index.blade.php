@extends('layout.backend.master')

@section('title', '分类列表')

@section('content')

@include('layout.backend.table_search', ['search' => 'backend::category.index', 'delete' => route('backend::category.batch')])

@inject('CategoryPresenter', 'App\Presenters\CategoryPresenter')

<table class="ui celled table center aligned list">
    <thead>
        <tr>
            <th>
                <div class="ui master checkbox">
                    <input type="checkbox">
                </div>
            </th>
            <th>分类名称</th>
            <th>文章数量</th>
            <th>排序</th>
            <th>显示</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(count($categories))
            @foreach($categories as $key => $value)
                <tr>
                    <td>
                        <div class="ui child checkbox" data-id="{{ $value->id }}">
                            <input type="checkbox" class="select-checkbox">
                        </div>
                    </td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->sort }}</td>
                    <td>{!! $CategoryPresenter->showDisplayName($value->display) !!}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                        <div class="ui buttons">
                            <a class="ui green icon button" href="{{ route('backend::category.edit', $value->id) }}">
                                <i class="write arrow icon"></i>
                            </a>
                            <a class="ui red icon button delete-category-btn" data-url="{{ route('backend::category.destroy', $value->id) }}">
                                <i class="remove arrow icon"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            @include('layout.backend.table_noresult', ['colspan' => 8])
        @endif
    </tbody>
    <tfoot>
        @include('layout.backend.table_paginate', ['value' => $categories, 'colspan' => 8])
    </tfoot>
</table>
@endsection
