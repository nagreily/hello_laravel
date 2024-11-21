<?php

namespace App\test;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;

class User2
{


    public function index()
    {
//        select(‘原生sql查询语句’，需要绑定到查询中的参数值)  绑定通常用于约束where， 使用‘？’来进行
//        select 返回一个array数组   数组中的每个结果都是一个 stdClass（php内置类） 对象
        $users = DB::select('select * from users where id = ?', [1]);
        //使用foreach访问select数组中返回的每一个元素
        foreach($users as $user){
            echo $user->name."<br>";
        }

//        另一种绑定方法
//        $users = DB::select('select * from users where id = :id', ['id'=>1]);

//        insert语句
        DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['lml','123','123']);

//        update语句   返回该执行语句影响的行数
        DB::update('update users set name = ?, email = ?, password = ? where id = ?', ['xll','23','23',1]);

//        delete语句     返回该执行语句影响的行数
        DB::delete('delete from users where id = ?', [1]);

//        其他普通语句，无返回
        DB::statement('drop table if exists users');

//        执行未预处理的语句 无绑定
        DB::unprepared('create table users');

//        数据库事务
        DB::transaction(function () {
           DB::table('users')->update(['name' => 'xll']);
           DB::table('users')->delete();
//           第二个可选参数，用来表示事务发生死锁时执行的次数，尝试次数结束后抛出异常
        },5);


        //        手动使用事务
        try {
            DB::beginTransaction();

            // 执行一系列数据库操作
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            // 处理事务失败的情况
        }


        return view('user.index',['users' => $users ]);
    }



}
