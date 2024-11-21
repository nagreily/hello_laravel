<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $option;
    public $selected;

    public function __construct()
    {
//        $this->option = $option;
    }

    /**
     * 判断给定的选项是否是当前选中的选项
     *
     * @param  string  $option
     * @return bool
     */
    public function isSelected($option)
    {
        return $option === $this->selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.button');
    }
}
