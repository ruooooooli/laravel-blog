@extends('layout.backend.master')

@section('title', '添加标签')

@section('content')
    {!! Form::model($tag, ['route' => ['backend::tag.update', $tag->id], 'class' => 'ui form', 'method' => 'put']) !!}
        <h4 class="ui horizontal header divider">填写信息</h4>
        <div class="field">
            {!! Form::label('name', '请输入标签名称', ['for' => 'name']) !!}
            {!! Form::text('name', null, ['id' => 'name', 'placeholder' => '请输入标签名称']) !!}
        </div>
        <div class="field">
            {!! Form::label('slug', '请输入标签别名', ['for' => 'slug']) !!}
            {!! Form::text('slug', null, ['id' => 'slug', 'placeholder' => '请输入标签别名']) !!}
        </div>
        <div class="field">
            {!! Form::label('description', '请输入标签描述', ['for' => 'description']) !!}
            {!! Form::text('description', null, ['id' => 'description', 'placeholder' => '请输入标签描述']) !!}
        </div>
        <h4 class="ui horizontal header divider">操作</h4>
        <div class="field">
            {!! Form::button('返回', ['class' => 'ui red button come-back']) !!}
            {!! Form::button('提交', ['class' => 'ui green button create-update-tag-btn', 'data-url' => route('backend::tag.index')]) !!}
        </div>
    {!! Form::close() !!}
@endsection
