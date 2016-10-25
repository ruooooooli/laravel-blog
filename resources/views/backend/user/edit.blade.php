@extends('layout.backend.master')

@section('title', '修改用户')

@section('content')
    {!! Form::model($user, ['route' => 'backend::user.store', 'class' => 'ui form']) !!}
        <h4 class="ui horizontal header divider">填写信息</h4>
        <div class="field">
            {!! Form::label('username', '请输入用户名') !!}
            {!! Form::text('username', null, ['id' => 'username', 'placeholder' => '请输入用户名']) !!}
        </div>
        <div class="field">
            {!! Form::label('email', '请输入邮箱地址') !!}
            {!! Form::email('email', null, ['id' => 'email', 'placeholder' => '请输入邮箱地址']) !!}
        </div>
        <div class="field">
            {!! Form::label('password', '请输入密码') !!}
            {!! Form::password('password', null, ['id' => 'password', 'placeholder' => '请输入密码']) !!}
        </div>
        <div class="field">
            {!! Form::label('password_confirmation', '请再次输入密码') !!}
            {!! Form::password('password_confirmation', null, ['id' => 'password_confirmation', 'placeholder' => '请再次输入密码']) !!}
        </div>
        <h4 class="ui horizontal header divider">操作</h4>
        <div class="field">
            {!! Form::button('返回', ['class' => 'ui red button come-back']) !!}
            {!! Form::button('提交', ['class' => 'ui green button create-update-user-btn', 'data-url' => route('backend::user.index')]) !!}
        </div>
    {!! Form::close() !!}
@endsection
