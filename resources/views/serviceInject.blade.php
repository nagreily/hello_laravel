{{-- 使用@inject 进行 服务注入 调用其他类的方法--}}
{{--@inject(服务变量名，需要解析的类型或接口名)--}}
@inject('metrics', 'App\Services\MetricsService')

{{--这个有问题--}}

{{--<div>--}}
{{--    Monthly Revenue: {{ $metrics->monthlyRevenue() }}.--}}
{{--</div>--}}


