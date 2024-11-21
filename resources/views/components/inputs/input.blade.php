{{--引入子视图--}}
{{--使用@include 在一个 Blade 视图文件中引入另一个 Blade 视图文件的内容，实现视图的模块化和重用--}}
<div>
    @include('alert')

    <form action="">
        <!--表单内容-->
    </form>
</div>

{{--不确定视图是否存在时使用@includeIf--}}
@includeIf('view.name', ['some' => 'data'])
{{--在某个表达式的值计算为 true 时 @include 一个视图--}}
@includeWhen('view.name', ['some' => 'data'])
{{--在某个表达式的值计算为 false 时 @include 一个视图--}}
@includeUnless('view.name', ['some' => 'data'])
{{--使用 includeFirst 指令要包含指定的视图数组中存在的第一个视图   第二个参数，传递数据给被包含的--}}
@includeFirst(['view1', 'view2', 'view3'], ['variableName' => $variableValue])

{{--使用each渲染数组或集合  视图名，数组或集合，变量，给定的数组为空时将会渲染该参数所对应的视图--}}
{{--@each不会继承父视图的变量，可使用foreach或include渲染子视图--}}
@each('view.name',$jobs,'job','view.empty')
