<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    use HasFactory;

//    使用belongsTo定义反向关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
