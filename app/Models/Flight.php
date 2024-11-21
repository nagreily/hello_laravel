<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $int)
 * @method static find(int $int)
 * @method static firstWhere(string $string, int $int)
 * @method static findOrFail(int $int)
 * @method static chunk(int $int, \Closure $param)
 * @method static firstOrCreate()
 * @method static firstOrNew(string[] $array)
 * @method static upsert(array[] $array, string[] $array1, string[] $array2)
 *
 */
class Flight extends Model
{
    use HasFactory;


//    使用$fillable让name可以被批量赋值
    protected $fillable = ['name'];

    protected $table = 'flights';         //关联的表

    protected $primaryKey = 'id';  //主键
    public $incrementing = true;         //设置主键是否主动递增

//    自定义时间格式，模型序列化为数组或者 JSON 的格式
    protected $dateFormat = 'U';

//    自定义时间戳字段名称
    const CREATED_AT = 'flight_created';
    const UPDATED_AT = 'flight_updated';

////    指定数据库连接
//    protected $connection = 'connection-name';


//    给字段指定默认值
    protected $attributes = ['delayed' => false];



    public function findModel()
    {
        // 通过主键查找一个模型...
        $flight = Flight::find(1);

//      查找符合查询条件的首个模型...
        $flight = Flight::where('active', 1)->first();

//      查找符合查询条件的首个模型的快速实现...
        $flight = Flight::firstWhere('active', 1);

//        使用firstOr方法执行给定的回调
        $model = Flight::where('legs', '>', 100)->firstOr(function () {
            // ...
        });
    }

    public function foundException()
    {
//        使用findOrFail或者FirstOrFail检索第一个结果，未找到则抛出异常
        $model =  Flight::findOrFail(1);
        $model =  Flight::where('legs','>',100)->firstOrFail();
    }

    public function setFunc()
    {

//        集合函数返回一个标量值
        $count = Flight::where('active', 1)->count();

        $max = Flight::where('active', 1)->max('price');
    }

    public function index()
    {
        $flights = Flight::where('active', 1)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();

        return view('flights.index', ['flights' => $flights]);
    }



    public function sets($flight)
    {
        $flights = $flight->reject(function ($flight) {
            return $flight->cancelled;
        });

        //        使用fresh模型重新加载模型，重新从数据库中加载模型，现有模型不受影响，使用refresh已有的模型会被重新加载
        $flight = Flight::where('number', 'FR 900')->first();
        $freshFlight = $flight->fresh();

    }

}




