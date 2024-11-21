<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;


class UserController extends Controller
{


    //增加类型提示
    public $users;

//    创建一个新的控制器实例
    public function __construct($users)
    {

        $this->users = $users;
////        添加中间件
//        $this->middleware('auth');
//        $this->middleware('log')->only('index');
//        $this->middleware('subscribed')->except('store');

////        使用闭包注册中间件
//        $this->middleware(function ($request, $next) {
//            // ...
//
//            return $next($request);
//        });

    }

    //控制器中使用隐式绑定
//    Route::get('users/{user}', [UserController::class, 'show']);
    public function show(User $user)
    {
//        return view('user.profile', ['user' => $user]);
    }

    public function login($id)
    {
        return view('auth.login');
    }



}
