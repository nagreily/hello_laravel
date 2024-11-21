<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class PagingController extends Controller
{
    public function index()
    {
//        每页显示15条数据
        $users = DB::table('users')->paginate(15);
        return view('paging', ['users' => $users]);
    }

    public function page()
    {
//        使用simplePaginate方法来执行更高效地查询（在数据量很大且不需要在渲染视图时显示每页的页码时非常有用）
        $users = DB::table('users')->simplePaginate(15);

    }

}
