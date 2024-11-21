<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//定义修改器

/**
 * @method static find(int $int)
 */
class UserModifiers extends Model
{
    use HasFactory;

    /**
     *
     * @param string $value
     * @return void
     */
    public function setFirstNameAttribute(string $value): string
    {
//       strtolower用于将字符串的所有字母转换为小写
        $this->attributes['first_name'] = strtolower($value);
    }

    public function setName($users)
    {
        $users = UserModifiers::find(1);
        $users->first_name = 'Sally';
    }
}
