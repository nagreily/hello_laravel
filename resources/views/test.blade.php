<h1>Laravel</h1>

{{--使用@来表示 Blade 渲染引擎应当保持不变--}}
Hello, @{{ name }}.

{{-- Blade --}}
@@json()

<!-- HTML 输出 -->
@json()
{{--使用@verbatim指令告诉Blade 引擎不要解析其中的内容，而是将其原样输出--}}
@verbatim
    <div class="container">
        Hello, {{ name }}.
    </div>
@endverbatim
