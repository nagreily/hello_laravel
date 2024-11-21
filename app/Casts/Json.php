<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use PhpParser\Node\Expr\Cast;

class Json implements CastsAttributes
{
//      get 方法负责将从数据库中获取的原始数据转换成对应的类型
    public function get($model, string $key, $value, array $attributes)
    {
        // TODO: Implement get() method.

//        json_decode将json解码为PHP变量
        return json_decode($value, true);
    }

//    set 方法则是将数据转换成对应的数据库类型以便存入数据库中
    public function set($model, string $key, $value, array $attributes)
    {
        // TODO: Implement set() method.
//      json_encode将PHP编码为json
        return json_encode($value);
    }

}
