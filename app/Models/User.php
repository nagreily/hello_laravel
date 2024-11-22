<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

/**
 * @method static find(int $int)
 * @method static whereIn(string $string, int[] $array)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

//Notifiable 是消息通知相关功能引用
//HasFactory 是模型工厂相关功能的引用
//Authenticatable 是授权相关功能的引用。


//通过table属性值名要交互的数据表的名称
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

//    对用户密码或其它敏感信息在用户实例通过数组或 JSON 显示时进行隐藏
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = '100')
    {
//        $this->attributes['email'] 获取用户邮箱
//        trim()剔除空白内容
//        strtolower()转换成小写
//        md5()转码，用于生成字符串的哈希值
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

}
