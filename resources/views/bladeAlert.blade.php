{{--在blade模板中使用组件标签--}}

{{--使用 x-slot 标签来定义命名插槽的内容。任何没有在 x-slot 标签中的内容都将传递给 $slot 变量中的组件--}}
<x-alert>
    <x-slot name="title">
        Server Error
    </x-slot>

    <strong>Whoops!</strong> Something went wrong!
</x-alert>

{{--作用域插槽  使用$component访问组件的数据或者方法--}}
<x-alert>
    <x-slot name="title">
        {{$component->formatAlert('Server Error')}}
    </x-slot>

    <strong>Whoops!</strong> Something went wrong!
</x-alert>
