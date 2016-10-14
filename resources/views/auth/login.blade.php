@extends('layout.backend.master')

@section('title', '登录')

@section('body-class', 'class="login-body-bg"')

@section('body')
<div class="login-form">
    <div class="ui container">
        <div class="ui centered stackable grid">
            <div class="six wide column">
                <div class="ui segments" align="center">
                    <div class="ui inverted blue padded segment">
                        <span class="ui header">Welcome Login</span>
                    </div>
                    <div class="ui segment">
                        {!! Form::open(['route' => 'backend::auth.login.post', 'class' => 'ui form']) !!}
                            <div class="field">
                                <div class="ui left icon input">
                                    {!! Form::text('login', null, ['id' => 'login', 'placeholder' => '请输入登录账号!']) !!}
                                    <i class="user icon"></i>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui left icon input">
                                    {!! Form::password('password', ['id' => 'password', 'placeholder' => '请输入登录密码!']) !!}
                                    <i class="lock icon"></i>
                                </div>
                            </div>
                            {!! Form::button('登录', ['class' => 'ui button blue', 'id' => 'login-button', 'data-url' => route('backend::index.index')]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
