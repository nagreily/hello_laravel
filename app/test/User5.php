<?php

namespace App\test;

use Illuminate\Support\Facades\DB;

class User5
{

    public function userSql()
    {
        $userSql = DB::table("users")->where('name','John')
//            使用where的第一个参数进行分组约束
        ->where(function ($query) {
            $query->where('votes','>',100)
            ->orWhere('title','Admin');
        })->get();
//        select * from users where name = 'John' and (votes > 100 or title = 'Admin')


//        使用whereExist 执行 where exist 语句
        $userSql1 = DB::table("users")
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->
                    from('orders')->
                    whereRaw('orders.user_id = users.id');
            })->get();
//              select * from users where exists (select 1 from orders where orders.user_id = users.id)



//        对多个字段排序
        $userSql2 = DB::table('users')
            ->orderBy('name', 'desc')
            ->orderBy('email', 'asc')
            ->get();


//        使用latest 和 oldest 进行排序  以一种便捷的方式通过日期（默认created_at）进行排序
        $userSql3 = DB::table('users')->
            latest()->first();

//      使用inRandomOrder随机查找一个用户
        $userSql4 = DB::table('users')->inRandomOrder()->first();



        $userSql5 = DB::table('users')->orderBy('name');
//        使用reorder删除已经存在的排序，可以在后面附加新排序
        $unorderedUsers = $userSql5->reorder()->get();


//        使用groupBy与having进行分组
        $userSql6 = DB::table('users')->groupBy('firstname','lastname')
            ->having('votes', '>', 100)->get();


//        跳过5个记录，获取接下来10个
        $userSql7 = DB::table('users')->skip(5)->take(10)->get();
        $userSql8 = DB::table('users')->offset(5)->limit(10)->get();



//        when 在第一个参数为true时执行后面的查询
        $role = 1;
        $userSql9 = DB::table('users')
            ->when($role, function ($query, $role) {
            return $query->where('role', $role);
        })->get();

        $sortBy = null;
        $userSql10 = DB::table('users')->when($sortBy, function ($query,$sortBy) {
            $query->orderBy($sortBy, 'desc');
        },function ($query){
            $query->orderBy('name', 'asc');
        });
    }



}
