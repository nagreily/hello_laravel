<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
{{--        使用@unless，条件为假时执行--}}
@unless (Auth::check())
    You are not signed in.
@endunless

{{--检查一个变量是否已经被设置并且不为 null--}}
@isset($records)
    // $records 已经定义但不为空
@endisset
{{--            用于检查一个变量是否为空--}}
@empty($records)
    // $records 为空……
@endempty
{{--鉴权指令，用于快速判断当前用户是否已经获得授权或是当前用户是游客--}}
@auth
    // 用户已经通过认证……
@endauth

@guest
    // 用户没有通过认证……
@endguest
{{--区块指令，使用 @hasSection来判断section中是否有内容--}}
@hasSection('navigation')
    <div class="pull-right">
        @yield('navigation')
    </div>

    <div class="clearfix"></div>
    {{--            使用endif结尾--}}
@endif
{{--使用@sectionMissing指令来判断section中是否没有内容--}}
@sectionMissing('navigation')
    <div class="pull-right">
        {{--@include  将其他 Blade 模板文件中的内容嵌入到当前模板中--}}
        @include('default-navigation')
    </div>
@endif

{{--  判断应用是否处于生产环境   通常用于在生产环境下执行一些与调试或开发无关的代码，例如性能优化或日志记录   --}}
@production
    // 在生产环境下执行的代码块
@endproduction
{{-- 用于检查当前应用程序的环境变量，并根据环境变量的取值执行相应的代码块 --}}
@env('staging')
    // 应用运行于「staging」环境……
@endenv

@env(['staging', 'production'])
    // 应用运行于 「staging」环境或生产环境……
@endenv
{{--循环指令--}}
@switch($i)
    @case(1)
        First case...
        @break

    @case(2)
        Second case...
        @break

    @default
        Default case...
@endswitch

{{--循环--}}
@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I'm looping forever.</p>
@endwhile
{{--使用@continue或者@break跳过或停止当前循环--}}
@foreach ($users as $user)
    @if ($user->type == 1)
        @continue
    @endif

    <li>{{ $user->name }}</li>

    @if ($user->number == 5)
        @break
    @endif
@endforeach

{{--使用$loop变量访问当前循环是否为首次或者末次--}}
@foreach($users as $user)
    @if($loop->first)
        This is the first iteration.
    @endif

    @if($loop->last)
        This is the last iteration.
    @endif
@endforeach
<p>This is user {{ $user->id }}</p>


{{--使用@php 执行php原生代码--}}
@php
    //
@endphp

</body>
</html>
