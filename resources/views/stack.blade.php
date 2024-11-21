{{--视图堆栈   管理和操作视图的层叠顺序--}}
@push('stack-name')
{{--    推送到堆栈内容--}}
@endpush

@stack('stack-name')
{{--输出堆栈内容--}}


@push('script')
{{--    推送--}}
@endpush
@prepend('script')
{{--    将内容置于栈顶--}}
@endprepend


