<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

//    只查询受欢迎的用户的作用域
//     在模型方法名前面加上scope来定义局部作用域

    public function scopePopular($query)
    {
        return $query->where('votes', '>',100);
    }

//    只查询 active 用户的作用域
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

//    判断将查询作用域限制为仅包含给定类型的用户
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
