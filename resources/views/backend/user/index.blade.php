@extends('layout.backend.master')

@section('title', '用户列表')

@section('content')

@include('layout.backend.table_search', ['searchRoute' => 'backend::user.index', 'delete' => route('backend::user.batch')])

<table class="ui celled table center aligned list">
    <thead>
        <tr>
            <th>
                <div class="ui master checkbox">
                    <input type="checkbox">
                </div>
            </th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>上次登录</th>
            <th>登录次数</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(count($users))
            @foreach($users as $key => $value)
                <tr>
                    <td>
                        <div class="ui child checkbox" data-id="{{ $value->id }}">
                            <input type="checkbox" class="select-checkbox">
                        </div>
                    </td>
                    <td>{{ $value->username }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->last_login }}</td>
                    <td>{{ $value->login_count }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                        <div class="ui buttons">
                            <a class="ui green icon button" href="{{ route('backend::user.edit', $value->id) }}">
                                <i class="write arrow icon"></i>
                            </a>
                            <a class="ui red icon button delete-btn" data-url="{{ route('backend::user.destroy', $value->id) }}">
                                <i class="remove arrow icon"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            @include('layout.backend.table_noresult', ['colspan' => 7])
        @endif
    </tbody>
    <tfoot>
        @include('layout.backend.table_paginate', ['value' => $users, 'colspan' => 7])
    </tfoot>
</table>
@endsection
