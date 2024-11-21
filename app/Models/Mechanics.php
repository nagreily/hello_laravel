<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 远程一对一关联模型，通过一个中间模型实现
mechanics
    id - integer
    name - string

cars
    id - integer
    model - string
    mechanic_id - integer

owners
    id - integer
    name - string
    car_id - integer
 */


class Mechanics extends Model
{
    use HasFactory;

    public function CarOwners()
    {
//        hasOneThrough（希望访问的模型，中间模型，中间模型外键，最终访问的模型外键，本地key，中间模型的本地key）
//        多对多hasManyThrough()
        return $this->hasOneThrough('App\Models\Owners', 'App\Models\Cars', 'id', 'id', 'car_owners_id');
    }
}
