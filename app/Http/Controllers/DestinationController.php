<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
//        查询软删除
        $destinations = Destination::all();

//        获取包括软删除模型在内的模型
        $destinations = Destination::withTrashed()->where('destinations_name','HK')->get();

//        仅获取软删除的模型 ,使用restore方法撤销软删除
        $destinations = Destination::onlyTrashed()->where('destinations_name','HN')->get()->restore();

        //强制删除单个模型实例...
        $destinations->forceDelete();
//      强制删除所有关联模型...
        $destinations->history()->forceDelete();

    }


}
