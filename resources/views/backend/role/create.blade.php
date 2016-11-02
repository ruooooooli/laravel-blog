@extends('layout.backend.master')

@section('title', '添加角色')

@section('content')
    {!! Form::open(['route' => 'backend::category.store', 'class' => 'ui form']) !!}
        <h4 class="ui horizontal header divider">填写信息</h4>
        <div class="field">
            {!! Form::label('name', '请输入角色名称', ['for' => 'name']) !!}
            {!! Form::text('name', null, ['id' => 'name', 'placeholder' => '请输入角色名称']) !!}
        </div>
        <div class="field">
            {!! Form::label('display_name', '请输入角色显示名称', ['for' => 'display_name']) !!}
            {!! Form::text('display_name', null, ['id' => 'display_name', 'placeholder' => '请输入角色显示名称']) !!}
        </div>
        <div class="field">
            {!! Form::label('description', '请输入角色描述', ['for' => 'description']) !!}
            {!! Form::text('description', null, ['id' => 'description', 'placeholder' => '请输入角色描述']) !!}
        </div>
        <h4 class="ui horizontal header divider">操作</h4>
        <div class="field">
            {!! Form::button('返回', ['class' => 'ui red button come-back']) !!}
            {!! Form::button('提交', ['class' => 'ui green button create-update-category-btn', 'data-url' => route('backend::category.index')]) !!}
        </div>
    {!! Form::close() !!}
@endsection
