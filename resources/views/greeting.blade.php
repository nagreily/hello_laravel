<html>
    <body>
{{--    变量置于花括号中以在视图中显示数据 --}}
{{--Hello, {!! $name !!}：不使用htmlspecialchars()进行转义--}}
        <h1>Hello, {{ $name }}</h1>

    </body>
</html>
