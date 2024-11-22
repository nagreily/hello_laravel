<!DOCTYPE html>
<html>
<head>
{{--   @yield站位，默认值--}}
    <title>@yield('title', 'Weibo App') - Laravel 第一个Laravel项目</title>
    {{--    引入 public/css/app.css 样式文件 ，使用mix函数动态加载样式代码 在webpack.mix.js文件中配置 --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
@include('layouts._header')

<div class="container">
    <div class="offset-md-1 col-md-10">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
    </div>
</div>
</body>
</html>

