@extends('layout.backend.master')

@section('title', '首页')

@section('content')
<h4 class="ui horizontal divider header">
    <i class="home icon"></i>项目预览
</h4>
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
            <a class="ui card" href="{{ route('backend::user.index') }}">
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
            <a class="ui card" href="{{ route('backend::role.index') }}">
                <div class="content">
                    <div class="header">角色</div>
                    <div class="description">
                        <div class="ui green horizontal statistic">
                            <div class="value">
                                {{ \App\Models\Role::count() }} 个
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
<h4 class="ui horizontal divider header">
    <i class="server icon"></i>站点信息
</h4>
<table class="ui definition table">
    <tbody>
        <tr>
            <td class="two wide column">服务器时间</td>
            <td>{{ date('Y-m-d  H:i:s') }}</td>
        </tr>
        <tr>
            <td class="two wide column">服务器 IP 地址</td>
            <td>{{ $_SERVER['SERVER_NAME'] . '(' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . ')' }}</td>
        </tr>
        <tr>
            <td class="two wide column">操作系统</td>
            <td>{{ PHP_OS }}</td>
        </tr>
        <tr>
            <td class="two wide column">数据库</td>
            <td>MYSQL</td>
        </tr>
        <tr>
            <td class="two wide column">PHP 版本</td>
            <td>{{ PHP_VERSION }}</td>
        </tr>
        <tr>
            <td class="two wide column">NGINX 版本</td>
            <td>{{ $_SERVER['SERVER_SOFTWARE'] }}</td>
        </tr>
        <tr>
            <td class="two wide column">上传大小</td>
            <td>{{ ini_get('upload_max_filesize') }}</td>
        </tr>
    </tbody>
</table>
@endsection
