<?php

namespace App\Providers;


use App\View\Components\Alert;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */


    public function boot()
    {
//        共享一段数据给应用程序的所有视图
        View::share('key','value');

//      禁用blade的双重编码
//        Blade::withoutDoubleEncoding();

//        手动注册包组件
//        当组件注册完成后，便可使用标签别名来对其进行渲染
        Blade::component('package-alert',Alert::class);

//        使用directive自定义指令 格式化时间
        Blade::directive('date', function ($expression) {
//            通过format格式化 调用date指令时，执行
            return "<?php echo ($expression)->format('Y-m-d'); ?>";
        });

//       使用blade::if 自定义条件语句  检查当前应用的云服务商
        Blade::if('cloud', function ($provider) {
            return config('filesystems.default') === $provider;
        });

//        监控程序执行的每一个 SQL 查询
        DB::listen(function ($query) {
//            $query -> sql
//            $query -> bindings
//            $query -> time
        });

//        定义不同的文件作为默认的分页视图
        Paginator::defaultView('view-name');
        Paginator::defaultSimpleView('view-name');

//      使用 Bootstrap CSS 构建的分页视图
        Paginator::useBootstrap();

//      使用withoutWrapping禁用顶层资源的包裹
        JsonResource::withoutWrapping();
    }
}
