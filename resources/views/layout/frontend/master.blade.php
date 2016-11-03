@extends('layout.master')

@section('stylesheets')

    @yield('stylesheets-inpage')

@endsection

@section('body')

    <div id="app">

        @yield('content')

    </div>

@endsection

@section('javascripts')

    @yield('javascripts-prefix')

    <script src="{{ elixir('assets/js/app.js') }}" charset="utf-8"></script>

    @yield('javascripts-inpage')

@endsection
