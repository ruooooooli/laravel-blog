<div class="ui secondary menu">
    <div class="item">
        <button type="button" class="ui red button select-delete-btn" name="button">批量删除</button>
    </div>
    <div class="right menu">
        <div class="item">
            {!! Form::open(['route' => $route, 'method' => 'get']) !!}
            <div class="ui icon input">
                <input type="text" name="key" placeholder="请输入关键词搜索" value="{{ $key }}">
                <i class="search link icon"></i>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
