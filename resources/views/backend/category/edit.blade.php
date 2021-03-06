@extends('layout.backend.master')

@section('title', '修改分类')

@section('content')
    {!! Form::model($category, ['route' => ['backend::category.update', $category->id], 'class' => 'ui form', 'method' => 'put']) !!}
        <h4 class="ui horizontal header divider">填写信息</h4>
        <div class="field">
            {!! Form::label('name', '请输入分类名称', ['for' => 'name']) !!}
            {!! Form::text('name', null, ['id' => 'name', 'placeholder' => '请输入分类名称']) !!}
        </div>
        <div class="field">
            {!! Form::label('sort', '请输入分类排序', ['for' => 'sort']) !!}
            {!! Form::number('sort', null, ['id' => 'sort']) !!}
        </div>
        <div class="field">
            <div class="ui toggle checkbox">
                {!! Form::checkbox('display', 'Y', ($category->display == 'Y'), ['id' => 'display']) !!}
                {!! Form::label('display', '是否显示', ['for' => 'display']) !!}
            </div>
        </div>
        <h4 class="ui horizontal header divider">操作</h4>
        <div class="field">
            {!! Form::button('返回', ['class' => 'ui red button come-back']) !!}
            {!! Form::button('提交', ['class' => 'ui green button create-update-category-btn', 'data-url' => route('backend::category.index')]) !!}
        </div>
    {!! Form::close() !!}
@endsection
