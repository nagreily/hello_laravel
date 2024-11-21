<?php

namespace App\Models;
use App\Http\Resources\User as UserResource;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static find(int $int)
 * @method static whereIn(string $string, int[] $array)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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


    public static function paginate($users)
    {
//        每页显示15条数据
        $users = DB::table('users')->paginate(15);

        return view('paging', ['users' => $users]);
    }

    public static function booted()
    {
//        在模型的静态方法booted中注册闭包，确保在模型加载时自动注册事件监听器
        static::saving(function ($model) {
//            在模型保存之前执行的逻辑
        });
        static::updated(function ($model) {
//            在模型更新后执行的逻辑
        });
    }

    public function userResource()
    {
        Route::get('/user', function () {
            return new UserResource(User::find(1));
        });
    }




}
