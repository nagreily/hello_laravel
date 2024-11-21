<!-- 创建一个子视图-->

{{--指定需要继承的视图--}}
@extends('layouts.app')
{{--向布局片段中注入内容--}}
@section('title', 'Page Title')

@section('sidebar')
{{--    向布局的 sidebar 追加（而非覆盖）内容。 在渲染视图时，@parent 指令将被布局中的内容替换--}}
    @parent
    <p>This is appended to the master sidebar.</p>
{{--@endsection 指令仅定义了一个片段， @show 则在定义的同时 立即 yield 这个片段--}}
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection
