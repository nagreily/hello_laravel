<?php

namespace App\Http\view\Composers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

//注册视图合成器
//在渲染视图之前为视图绑定数据或逻辑
//将共享的数据逻辑封装在一个地方，以便在多个视图中重复使用
class ViewServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            'profile', 'App\Http\view\Composers\ProfileComposer'
        );

        // Using Closure based composers...
        View::composer('dashboard', function ($view) {
            //
        });
    }
}
