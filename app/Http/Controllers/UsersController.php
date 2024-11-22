<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function show(User $user)
    {
//        compact('user') 将会创建一个关联数组 ['user' => $user]，将 $user 变量传递给视图
        return view('user.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            /*required验证是否为空
            unique:users 对数据表users验证是否唯一
            'min:3|max:50' 长度验证
            email 邮箱格式验证
            confirmed 密码匹配验证
            */
            'name' => 'required|unique:users|max:100',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

//      使用 session() 方法来访问会话实例
//        只在下一次的请求内有效时，使用 flash 方法
        session()->flash('success', '注册成功');
        return redirect()->route('users.show', [$user]);
    }
}

