<?php

namespace App\test;

use Illuminate\Support\Facades\DB;

class User6
{
    public function userInsert()
    {
        DB::table('users')->insert(['email' => 'test0.net','votes' => 1]);
//        使用二维数组插入
        DB::table('users')->insert([['email' => 'test1.net','votes' => 2],['email' => 'test2.net','votes' => 3]]);

//        使用insertOrIgnore 在插入时忽略 记录重复错误
        DB::table('users')->insertOrIgnore([['email' => 'test1.net','votes' => 2],['email' => 'test2.net','votes' => 3]]);


        $id = DB::table('users')->insertGetId(['email' => 'test0.net','votes' => 2]);

        $affected = DB::table('users')
            ->where('id', $id)
//            通过update进行更新
            ->update(['votes' => 3]);

//自增、自减   (参数，递增/递减的量)
        DB::table('users')->increment('votes');
        DB::table('users')->increment('votes', 5);
        DB::table('users')->decrement('votes');
        DB::table('users')->decrement('votes', 5);

//清空表
        DB::table('users')->truncate();

//共享锁防止指定的列被修改，知道事务提交为止
        DB::table('users')->where('votes', '>', 100)->sharedLock()->get();

//        使用「 update 」锁可以避免数据行被其他共享锁修改或选定
        DB::table('users')->where('votes', '>', 100)->lockForUpdate()->get();

//使用dd来调试并终止请求
        DB::table('users')->where('votes', '>', 100)->dd();
//使用dump调试并继续请求
        DB::table('users')->where('votes', '>', 100)->dump();

    }
}
