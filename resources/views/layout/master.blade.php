<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        @yield('stylesheets')

    </head>
    <body @yield('body-class')>

        @yield('body')

        @yield('javascripts')

    </body>
</html>
