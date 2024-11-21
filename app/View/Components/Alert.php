<?php

namespace App\View\Components;

use Illuminate\View\Component;



//基于类的组件
class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

//    类型
    public $type;
//    消息
    public $message;
//
    public $alertType="danger";


//    创建一个组件实例
//    组件的构造器参数命名方式应该使用驼峰式$alertType
    public function __construct($type, $message, $alertType)
    {
        $this->type = $type;
        $this->message = $message;
        $this->alertType = $alertType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */


    /**
     * 获取组件的视图 / 内容
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
//        在render返回组件视图模板 /view/components/alert.blade.php
//        return view('components.alert');


//        在类的渲染方法中访问组件的名称，属性以及插槽
//        return function (array $data) {
////            componentName 等于使用 x- 作为前缀后 HTML 标签中使用的名称
//             $data['componentName'];
////            attributes 元素包含所有可能出现在 HTML 标签中的属性
//             $data['attributes'];
////            slot 元素是一个 Illuminate\Support\HtmlString 实例，该实例包含组件中的插槽定义的内容
//             $data['slot'];
//            return '<div>Component content</div>';
//        };

//      内联组件视图 用于小型组件  从render中返回组件的内容
        return <<<'blade'
            <div class="alert alert-danger">
                {{ $slot }}
            </div>
        blade;

    }
}
