<?php

namespace App\View\Components;

use Illuminate\View\Component;

//使用php artisan make:component Alert --inline生成内联视图组件
//该方法通常用于简单的组件或需要动态生成内容的组件
class inAlert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
<div>
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>
blade;
    }
}
