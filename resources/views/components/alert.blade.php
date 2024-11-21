{{--使用php artisan make:component Alert 创建组件
组件：将视图片段封装为可重用组件的机制
插槽： Blade 组件中用于传递参数或内容的占位符。通过使用插槽，可以在组件内部动态地填充内容
--}}

<div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->

{{--    blade组件标签--}}
    <x-alert/>

{{--    传递数据到组件中--}}
    <x-alert type="error" :message="$message"/>

</div>

{{--回显变量名来显示组件的 public 变量--}}
<div class="alert alert-{{ $type }}">
{{--    插槽--}}
    {{ $message }}
{{--    组件构造器驼峰式命名法 标签使用--}}
    <x-alert alert-type="danger" />
{{--class属性不是组件必须的数据，--}}
    <x-alert type="error" :message="$message" class="mt-4"/>

</div>
{{--使用$arrtibutes将所有不属于组件的构造器的属性自动添加到组件的「属性包」中--}}
<div {{ $attributes }}>
    <!-- Component Content -->
</div>

{{--使用merge指定默认/合并属性--}}
<div {{$attributes->merge(['class'=>'alert alert-'.$type])}}>
    {{$message}}
</div>
{{--最终展示结果如下--}}
{{--<div class="alert alert-error mb-4">--}}
{{--    <!-- Contents of the $message variable -->--}}
{{--</div>--}}

{{--使用filter方法过滤属性--}}
{{--<div {{ $attributes->filter(fn ($value, $key) => $key == 'foo') }}></div>--}}
<div <?php foreach ($attributes as $key => $value) {
    if ($key == 'foo') {
        echo $key . '="' . $value . '"';
    }
} ?>></div>


{{--使用 whereStartsWith 方法来检索所有以特定字符串开头的键所对应的属性--}}
<div {{$attributes->whereStartsWith('wire:model')}}></div>

{{--使用first方法渲染属性包中的第一个属性--}}
<div {{ $attributes->whereStartsWith('wire:model')->first() }}></div>

<!-- /resources/views/components/alert.blade.php -->
{{--通过插槽slot向组件传递附加内容--}}
<div class="alert alert-danger">
    {{ $slot }}
</div>

<x-alert>
    <strong>Whoops!</strong> Something went wrong!
</x-alert>

{{--放置多个插槽--}}
<span class="alert-title">{{$title}}</span>
<div class="alert alert-danger">
    {{$slot}}
</div>

{{--定义匿名组件，不需要创建单独的组件类--}}
<x-component>
    <h1>Hello, this is an anonymous component!</h1>
</x-component>


