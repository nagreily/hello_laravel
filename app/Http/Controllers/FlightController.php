<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{

    public function store(Request $request)
    {

//        验证请求,数据库新增一条记录，先创建模型实例，给实例设置属性，调用save方法进行插入
        $flight = new Flight;
        $flight->name = $request->name;
        $flight->fill(['name'=>'F22']);   //在实例中使用fill方法进行赋值
        $flight->save();
    }

//    更新模型
    public function updateModel()
    {
        $flight = Flight::find(1);

        $flight->name = 'New Flight Name';

        $flight->save();
    }


//    使用update进行批量更新
    public function batchUpdate()
    {
        Flight::where('id', 1)
            ->where('departure_city','HK')
            ->update(['name' => 'New Flight Name']);

//        使用firstOrCreate方法检索name，不存在就创建新模型并插入数据库
        $flight = Flight::firstOrCreate(['name'=>'F10']);

//        使用firstOrCreate方法检索name，不存在就创建新模型，未保存到数据库，需要调用save方法来保存
        $flight = Flight::firstOrNew(['name'=>'F10'])->save();


//        使用upsert方法进行进行数据插入或更新，（要插入或更新的列（数组），用于判断记录是否已经存在的唯一键（数组），发生冲突时需要更新的列）
        Flight::upsert([
            ['departure' => 'Oakland', 'destination' => 'San Diego', 'price' => 99],
            ['departure' => 'Chicago', 'destination' => 'New York', 'price' => 150]
        ], ['departure', 'destination'], ['price']);

    }

    public function deleteModel()
    {
        $flight = Flight::find(1);
//      在模型实例上调用delete删除模型
        $flight->delete();


//        直接使用 destroy 方法来删除模型，不需要实例
        Flight::destroy(1);
        Flight::destroy(1, 2, 3);
        Flight::destroy([1, 2, 3]);
        Flight::destroy(collect([1, 2, 3]));

//        使用查询删除行
        $deleteRows = Flight::where('active',0)->delete();
    }
}
