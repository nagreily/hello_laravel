<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
模型关联多对多表结构

 users
    id - integer
    name - string

roles
    id - integer
    name - string

role_user
    user_id - integer
    role_id - integer

*/
class role extends Model
{
    use HasFactory;

    /**
     * 标识 ID 是否自增
     *
     * @var bool
     */
    public $incrementing = true;

//  使用touches 属性进行同步更新父模型的update_at时间戳
    protected $touches = ['Users'];

    public function users()
    {
//        拥有此角色的用户
//        使用using关联中间表模型
        return $this->belongsToMany('App\Models\Users')
            ->using('App\Models\RoleUser')
//            将列名传递给 withPivot 方法，就可以从 UserRole 中间表中检索出 created_by 和 updated_by 两列数据
            ->withPivot('created_at','updated_at');
    }


}
