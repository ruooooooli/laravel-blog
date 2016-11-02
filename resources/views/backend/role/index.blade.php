@extends('layout.backend.master')

@section('title', '角色列表')

@section('content')

@include('layout.backend.table_search', ['searchRoute' => 'backend::role.index', 'delete' => route('backend::role.batch')])

<table class="ui celled table center aligned list">
    <thead>
        <tr>
            <th>
                <div class="ui master checkbox">
                    <input type="checkbox">
                </div>
            </th>
            <th>名称</th>
            <th>显示名称</th>
            <th>描述</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(count($roles))
            @foreach($roles as $key => $value)
                <tr>
                    <td>
                        <div class="ui child checkbox" data-id="{{ $value->id }}">
                            <input type="checkbox" class="select-checkbox">
                        </div>
                    </td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->display_name }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                        <div class="ui buttons">
                            <a class="ui green icon button" href="{{ route('backend::role.edit', $value->id) }}">
                                <i class="write arrow icon"></i>
                            </a>
                            <a class="ui red icon button delete-btn" data-url="{{ route('backend::role.destroy', $value->id) }}">
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
        @include('layout.backend.table_paginate', ['value' => $roles, 'colspan' => 6])
    </tfoot>
</table>
@endsection
