<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function imageAble()
    {
//        获取拥有此图片的模型
        return $this->morphTo();
    }
}
