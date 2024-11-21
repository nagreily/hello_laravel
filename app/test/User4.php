<?php

namespace App\test;

use Illuminate\Support\Facades\DB;

class User4
{
//    聚合方法，比如 count，max，min，avg, sum
    public function agg()
    {
        $users = DB::table('users')->count();

        $price = DB::table('orders')->max('price');

        $price = DB::table('orders')
            ->where('finalized', 1)
            ->avg('price');
    }

    public function isExist()
    {
//        判断查询结果是否存在
        return DB::table('orders')->where('finalized',1)->exists();
//        return DB::table('orders')->where('finalized', 1)->doesntExist();
    }

    public function select()
    {
        $users = DB::table('users')->select('name', 'email as user_email')->get();

//        distinct去重
        $users1 = DB::table('users')->distinct()->get();

//        在现有的查询语句中加入一个字段
        $query = DB::table('users')->select('name');
        $users = $query->addSelect('age')->get();


        $orders = DB::table('orders')
//            使用selectRaw插入原生表达式
            ->selectRaw('price * ? as price_with_tax', [1.0825])
            ->get();

        $orders1 = DB::table('orders')
//            使用whereRaw将原生的where注入到查询中
            ->whereRaw('price > IF(state = "TX", ?, 100)', [200])
            ->get();

//        使用havingRaw或orHavingRaw进行
        $orders2 = DB::table('orders')->select('department',DB::raw('sum(price) as count'))
        ->groupBy('department')
        ->havingRaw('count > ?',[1])->get();

//        使用orderByRaw设置原生order by语句
        $orders3 = DB::table('users')->
        orderByRaw("name", "asc")->get();

        $orders4 = DB::table('orders')
            ->select('city', 'state')
            ->groupByRaw('city, state')
            ->get();


//        使用join进行内连接（表名，连接方式）
        $orders5 = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

//        左连接 users和posts
        $orders6 = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();

//        右连接
        $orders7 = DB::table('users')
            ->rightJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();

//        交叉连接
        $sizes = DB::table('sizes')
            ->crossJoin('colors')
            ->get();

        DB::table('users')->join('contacts', function ($join) {
            $join->on('users.id', '=', 'contacts.user_id');
        })->get();

        DB::table('users')->join('orders', function ($join) {
            $join->on('users.id', '=', 'orders.user_id')
//                使用where或者orWhere方法增加连接条件
                ->where('contacts.user_id', '>', 5);
        })->get();

//        使用joinSub进行子查询连接joinSub/leftJoinSub/rightJoinSub(子查询，表别名，关联字段)
        $latestPosts = DB::table('posts')->select('user_id',DB::raw('Max(created_at) as latest_post_created_at)'))
                        ->where('is_published', true)
                        ->orderBy('user_id', 'desc');

        $users2 = DB::table('users')->joinSub($latestPosts, 'latestPost', function ($join) {
            $join->on('users.id', '=', 'latestPost.user_id');
        });


//        使用union进行查询连接

        $first = DB::table('users')->whereNull('firstname');

        $userName = DB::table('users')->whereNull('lastname')->union($first)->get();

        //    where比较 where(列名，运算符，比较值)   比较相等第二个参数可以省略
        $users3 = DB::table('users')->where('firstname','=','luna');

//        传递条件数组
        $users4 = DB::table('users')->where(['state','=','1'],['subscribe','<>','1'])
//            使用orWhere增加查询条件
            ->orWhere('gender','female')->get();
//        select * form users where (state = '1' and subscribe != '1') or gender = 'female'


        $users5 = DB::table('users')->where('votes','>',100)->
            orWhere(function ($query) {
                $query->where('name','Abigail')
                    ->where('votes','>',50);
        })->get();
//             select * from users where votes > 100 or (name = 'Abigail' and votes > 50)
    }


}

