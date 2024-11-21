<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight1 extends Model
{

//    一对多模型关联
    public function comments()
    {
        return $this->hasMany('App\Models\Comments');
    }
}
