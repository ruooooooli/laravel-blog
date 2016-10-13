@extends('layout.master')

@section('stylesheets')

    <link rel="stylesheet" href="{{ elixir('assets/css/styles.css') }}" media="screen" title="no title">

    @yield('stylesheets-inpage')

@endsection

@section('body-class', 'class="backend-body-bg"')

@section('body')
    <div class="body">
        @include('layout.backend.header')

        <div class="ui container">
            <div class="ui segment">

                @yield('content')

            </div>
        </div>
    </div>
@endsection

@section('javascripts')

    @include('layout.backend.prefix_js')

    <script src="{{ elixir('assets/js/scripts.js') }}" charset="utf-8"></script>

@endsection
