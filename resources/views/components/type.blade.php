{{--匿名组件中  Blade 模板的顶层使用 @props 指令来指定哪些属性应该作为数据变量--}}
@props(['type'=>'info','message'])
<div {{$attributes->merge(['class'=>'alert alert'.$type])}}>
    {{$message}}
    <!-- Well begun is half done. - Aristotle -->
</div>

{{--动态组件--}}
{{--使用 Laravel 内置的 dynamic-component 组件来渲染一个基于值或变量的组件--}}
<x-dynamic-component :component="$componentName" class="mt-4" />



