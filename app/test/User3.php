<?php

namespace App\test;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class User3
{
    public function index()
    {
//        使用get方法查询整个表，返回一个包含 Illuminate\Support\Collection 实例的结果，其中每一条记录都是 PHP stdClass 对象的一个实例
//        与select类似
        $users = DB::table('users')->get();
        return view('users.index', ['users' => $users]);
    }

    public function firstUser()
    {
//        使用first方法 从数据库中获取单行或单列
        $users = DB::table('users')->where('id', 1)->first();
        echo $users->name;

//        使用value获取“email”字段的值
        $email = DB::table('users')->where('id', 1)->value('email');
        echo $email;
    }

    public function id()
    {
//        使用find方法获取对应id的一行数据
        DB::table('users')->find('1');
    }


    public function getColumn()
    {
//        使用pluck方法获取一列的
        $titles = DB::table('users')->pluck('name');

        foreach ($titles as $title) {
            echo $title;
        }

//        自定义键名name
        $roles = DB::table('users')->pluck('title','name');
//        指定自定义的key：name
        foreach ($roles as $name => $title) {
            echo $title;
        }
    }

    public function chunk()
    {
//        使用chunk方法进行分块  分成100条记录为一份
        DB::table('users')->orderBy('id')->chunk(100,function ($users) {
            foreach ($users as $user) {
                echo $user->name;
            }
//            通过在闭包中返回false来中断分块
            return false;
        });
    }

    public function chunkById()
    {
//        分块处理 更新active 为 true
        DB::table('users')->where('active',false)
            ->chunkById(100,function ($users) {
                foreach ($users as $user) {
                    DB::table('users')->where('id', $user->id)->update(['active' => true]);
                }
            });
    }


}
