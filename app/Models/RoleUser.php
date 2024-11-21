<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


//自定义中间表模型 需要扩展Pivot
class RoleUser extends Pivot
{
    use HasFactory;

    public function midSave($role,$expires)
    {
//        在中间表中保存数据，接受一个额外的数组在中间表中保存额外的信息 'expires' => $expires
        User::find(1)->roles()->save($role, ['expires' => $expires]);

//        使用updateExistingPivot()更新中间表的信息
        $user = User::find(1);
        $user->roles()->updateExistingPivot($role, ['expires' => $expires]);
    }

}
