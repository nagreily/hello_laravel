
{{--定义应用布局--}}
<html>
    <head>
        <title>App name - @yield('title')</title>
{{--        @yield用来显示片段的内容--}}
    </head>
    <body>
        @section('sidebar')
{{--            @section 指定片段内容--}}
            this is a master sidebar
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>

{{--使用json_encode()向视图传递一个数组并将其渲染成 JSON--}}
{{--<script>--}}
{{--    var app = <?php $array = array();--}}
{{--    echo json_encode($array); ?>;--}}
{{--</script>--}}

