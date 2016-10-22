@extends('layout.backend.master')

@section('title', '首页')

@section('content')
<div class="ui equal width grid">
    <div class="row">
        <div class="column">
            <a class="ui card" href="{{ route('backend::category.index') }}">
                <div class="content">
                    <div class="header">分类</div>
                    <div class="description">
                        <div class="ui green horizontal statistic">
                            <div class="value">
                                {{ App\Models\Category::count() }} 个
                            </div>
                        </div>
                    </div>
                </div>
                <div class="extra content">
                    <div class="right floated">
                        点击查看 <i class="arrow right icon"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="column">
            <a class="ui card" href="{{ route('backend::post.index') }}">
                <div class="content">
                    <div class="header">文章</div>
                    <div class="description">
                        <div class="ui green horizontal statistic">
                            <div class="value">
                                {{ App\Models\Post::count() }} 篇
                            </div>
                        </div>
                    </div>
                </div>
                <div class="extra content">
                    <div class="right floated">
                        点击查看 <i class="arrow right icon"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="column">
            <a class="ui card" href="">
                <div class="content">
                    <div class="header">用户</div>
                    <div class="description">
                        <div class="ui green horizontal statistic">
                            <div class="value">
                                {{ App\Models\User::count() }} 位
                            </div>
                        </div>
                    </div>
                </div>
                <div class="extra content">
                    <div class="right floated">
                        点击查看 <i class="arrow right icon"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="column">
            <a class="ui card" href="">
                <div class="content">
                    <div class="header">角色</div>
                    <div class="description">
                        <div class="ui green horizontal statistic">
                            <div class="value">
                                {{ 5 }} 个
                            </div>
                        </div>
                    </div>
                </div>
                <div class="extra content">
                    <div class="right floated">
                        点击查看 <i class="arrow right icon"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="ui raised segments">
    <div class="ui segment">
        <h4>服务器时间 : {{ date('Y-m-d  H:i:s') }}</h4>
    </div>
    <div class="ui segment">
        <h4>服务器 IP : {{ $_SERVER['SERVER_NAME'] . '(' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . ')' }}</h4>
    </div>
    <div class="ui segment">
        <h4>操作系统 : {{ PHP_OS }}</h4>
    </div>
    <div class="ui segment">
        <h4>数据库 : MYSQL</h4>
    </div>
    <div class="ui segment">
        <h4>PHP 版本 : {{ PHP_VERSION }}</h4>
    </div>
    <div class="ui segment">
        <h4>NGINX 版本 : {{ $_SERVER['SERVER_SOFTWARE'] }}</h4>
    </div>
    <div class="ui segment">
        <h4>上传大小 : {{ ini_get('upload_max_filesize') }}</h4>
    </div>
</div>
@endsection
