<?php


use App\Models\Flight;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/

//配置路由

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');   //name为路由指定名称
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('/signup', 'UsersController@create')->name('signup');




//<!--用于定义 web 界面的路由-->
//<!--这里面的路由会被分配给 web 中间件组，它提供了会话状态和 CSRF 保护等功能-->

////uri，action
//Route::get('user/{id}',[UserController::class,'show']);
//
////中间件 可以在路由文件中分配给控制器的路由    拦截器，访问profile之前需要通过auth文件
//Route::get('profile', [UserController::class, 'show'])->middleware('auth');


//
//Route::get('/', function () {
////    视图文件名    数据数组
//    return view('welcome');
//});
//
////视图路由
//Route::get('greeting', function () {
////    视图文件名    数据数组
//    return view('greeting', ['name' => 'James']);
//});
//
////结构视图
//Route::get('CS', function () {
////    视图文件名    数据数组
//    return view('ControlStructures', ['records'=> 2]);
//});
//
//////显示数据
////Route::get('greeting', function () {
////    return view('welcome', ['name' => 'Samantha']);
////});
//
//
////使用view将blade视图从路由中返回
//Route::get('child', function () {
//    return view('child');
//});
//
//Route::get('app', function () {
//    return view('layouts.app');
//});
//
//Route::get('users', function () {
//    $users = App\Models\User::paginate(15);
////    生成像 http://example.com/custom/url?page=N 的分页链接
////    $users->withPath('custom/url');
//});
//
////    使用chunk方法进行分块
//Flight::chunk(200, function ($flights) {
//    foreach ($flights as $flight) {
//        echo $flight->name . "\n";
//    }
//});




