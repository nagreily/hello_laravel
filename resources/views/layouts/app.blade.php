
{{--定义应用布局--}}
<html>
    <head>
{{--        显示标题--}}
        <title>App name - @yield('title')</title>
    {{--        @yield用来显示片段的内容--}}
    </head>
    <body>
    @section('sidebar')
        {{--            @section 指定片段内容--}}
        this is a master sidebar
        {{--    使用@show作为@section的结尾--}}
    @show

    <div class="container">
{{--    定义一个内容占位符。@yield 指令允许子视图（继承父视图的视图）填充具有指定名称的占位符--}}
        @yield('content')
    </div>
    </body>
</html>
