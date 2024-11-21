<div class="container">
    @foreach($users as $user)
        {{$users->name}}
    @endforeach
</div>

{{--links 方法会渲染结果集中剩余页面的链接,每个链接都已经包含了 page URL 变量--}}
{{$users->links()}}

{{--附加参数到分页链接，使用 appends 方法向分页链接中添加查询参数--}}

{{$users->appends(['sort'=>'votes'])->links()}}

{{--将所有查询参数添加到分页链接--}}
{{ $users->withQueryString()->links() }}

{{--使用fragment方法在每页链接中添加#foo--}}
{{ $users->fragment('foo')->links() }}

{{--控制在分页器 URL「窗口」的每一侧显示多少个附加链接  咋用？--}}
{{ $users->onEachSide(5)->links() }}

{{--自定义分页视图--}}
{{ $paginator->links('view.name') }}

{{--// 将数据传递给视图...--}}
{{ $paginator->links('view.name', ['foo' => 'bar']) }}

{{--自定义分页视图最简单的方法是使用 vendor:publish 命令将它们输出到 resources/views/vendor 目录--}}
{{--php artisan vendor:publish --tag=laravel-pagination--}}
