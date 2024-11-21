<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


//php artisan make:resource Users --collection
//资源类：使用toArray将给定的模型转换成一个可以返回给用户数组
class Users extends ResourceCollection
{

//    指示是否应保留资源的集合键，true，集合的键被保留
    public $preserveKeys = true;

//    使用collects属性定义资源类
    public $collects = 'App\Http\Resources\Member';


//      ‘数据’包装器，改变资源相应的名称，默认为data
    public static $wrap = 'users';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ['data' => $this->collection,'links'=>['self'=>'link-value']];
    }
}
