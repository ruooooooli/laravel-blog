@extends('layout.backend.master')

@section('title', '文章列表')

@section('content')
<table class="ui celled table">
    <thead>
        <tr>
            <th>Header</th>
            <th>Header</th>
            <th>Header</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Cell</td>
            <td>Cell</td>
            <td>Cell</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">
            <div class="ui right floated pagination menu">
                <a class="icon item">
                    <i class="left chevron icon"></i>
                </a>
                <a class="item">1</a>
                <a class="item">2</a>
                <a class="item">3</a>
                <a class="item">4</a>
                <a class="icon item">
                    <i class="right chevron icon"></i>
                </a>
            </div>
        </th>
        </tr>
    </tfoot>
</table>
@endsection
