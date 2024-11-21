<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $int)
 */
class UserAccessor extends Model
{
//    定义访问器，访问器（Accessors）允许你在获取模型属性值时对其进行处理和格式化。
//     通过定义访问器，你可以在获取模型属性时自动对其进行转换，而不需要手动处理

//此方法需要将get...Attribute 驼峰式命名


    /**
     * @param $value
     * @return string
     */
    public function getFirstNameAttribute($value): string
    {
//        ucfirst用于将字符串的第一个字符转换为大写字母
        return ucfirst($value);
    }


    public function firstName($users)
    {
        $users = UserAccessor::find(1);
//      字段的原始值被传递到访问器中，处理后返回结果
        $firstName = $users->first_name;

    }
}
