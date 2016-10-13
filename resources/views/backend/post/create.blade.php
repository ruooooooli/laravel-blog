@extends('layout.backend.master')

@section('title', '添加文章')

@section('content')
{!! Form::open(['route' => 'backend::post.store', 'class' => 'ui form', 'files' => true]) !!}
    <h4 class="ui horizontal header divider">填写信息</h4>
    <div class="field">
        {!! Form::label('title', '请输入文章标题', ['for' => 'title']) !!}
        {!! Form::text('title', null, ['id' => 'title', 'placeholder' => '请输入文章标题']) !!}
    </div>
    <div class="field">
        {!! Form::label('category_id', '请选择文章分类', ['for' => 'category_id']) !!}
        <div class="field">
            {!! Form::select('category_id', $categories, null, ['class'  => 'ui fluid search dropdown']) !!}
        </div>
    </div>
    <div class="field">
        {!! Form::label('tags', '请选择文章标签', ['for' => 'tags']) !!}
        <div class="field">
            {!! Form::select('tags', $tags, null, ['class' => 'ui fluid dropdown', 'multiple' => '', 'id' => 'tags']) !!}
        </div>
    </div>
    <div class="field">
        <div class="ui top attached tabular menu">
            <a class="active item" data-tab="markdown-source" id="markdown-source-tab">编写 Markdown</a>
            <a class="item" data-tab="markdown-view" id="markdown-view-tab">预览 Markdown</a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="markdown-source">
            <div class="field">
                {!! Form::textarea('markdown-source', null, ['id' => 'markdown-source', 'rows' => 15]) !!}
            </div>
            <div class="field">
                <div class="ui tiny progress" id="upload-file-progress">
                    <div class="bar"></div>
                </div>
                <label for="uploadfile" class="ui icon blue button">
                    <i class="cloud upload icon"></i>
                    上传文件
                </label>
                <input type="file" id="uploadfile" style="display:none" name="uploadfile">
            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="markdown-view">
            <div id="markdown-html" class="markdown-body"></div>
        </div>
    </div>
    <h4 class="ui horizontal header divider">操作</h4>
    <div class="field">
        {!! Form::button('返回', ['class' => 'ui red button come-back']) !!}
        {!! Form::button('提交', ['class' => 'ui green button create-update-post-btn', 'data-url' => route('backend::post.index')]) !!}
    </div>
{!! Form::close() !!}
@endsection
