@extends('layouts.default')
@section('content')
    <div class="jumbotron">
        <h1>hello laravel</h1>
        <p class="lead">
            5555 <a href="https://learnku.com/courses/laravel-essential-training/8.x/style-beautification/9812">laravel学习</a>
            主页
        </p>
        <p>
            使用bootstrap作为前端框架，在app.scss中引入
        </p>
        <p>
            <a class="btn btn-lg btn-success" href="{{route('signup')}}" role="button">现在注册</a>
        </p>

    </div>
@stop
