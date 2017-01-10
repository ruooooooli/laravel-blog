<div class="ui blue fixed inverted menu">
    <div class="ui container">
        <a href="{{ route('backend::index.index') }}" class="header item">
            <i class="large home icon"></i>
        </a>

        <div class="ui simple dropdown item">
            <i class="large tasks icon"></i>分类
            <div class="menu">
                <a class="item" href="{{ route('backend::category.index') }}">分类列表</a>
                <a class="item" href="{{ route('backend::category.create') }}">添加分类</a>
            </div>
        </div>
        <div class="ui simple dropdown item">
            <i class="large talk icon"></i>文章
            <div class="menu">
                <a class="item" href="{{ route('backend::post.index') }}">文章列表</a>
                <a class="item" href="{{ route('backend::post.create') }}">添加文章</a>
            </div>
        </div>
        <div class="ui simple dropdown item">
            <i class="large tag icon"></i>标签
            <div class="menu">
                <a class="item" href="{{ route('backend::tag.index') }}">标签列表</a>
                <a class="item" href="{{ route('backend::tag.create') }}">添加标签</a>
            </div>
        </div>
        <div class="ui simple dropdown item">
            <i class="large users icon"></i>用户
            <div class="menu">
                <a class="item" href="{{ route('backend::user.index') }}">用户列表</a>
                <a class="item" href="{{ route('backend::user.create') }}">添加用户</a>
            </div>
        </div>
        <div class="right menu">
            <div class="ui simple dropdown item">
                <i class="large user icon"></i>{{ Auth::user()->email }}
                <div class="menu">
                    <a class="item" href="{{ route('backend::user.edit', Auth::user()->id) }}">个人信息</a>
                    <a class="item" href="{{ route('backend::auth.logout') }}" data-ajax="not">退出登录</a>
                </div>
            </div>
        </div>
    </div>
</div>
