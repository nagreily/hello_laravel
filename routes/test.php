<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
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


//<!--用于定义 web 界面的路由-->
//<!--这里面的路由会被分配给 web 中间件组，它提供了会话状态和 CSRF 保护等功能-->

//Route::get('/',function(){
//    return view('hello',['name'=> 'lml']);
//});


//基本视图路由
Route::get('/', function () {
    return view('welcome');
});


//注册一个可响应多个http请求的路由
Route::match(['get', 'post'], '/', function (){
    //
});

//重定向路由,状态码默认302，可修改
Route::redirect('/here','there','301');

//视图路由,第三个可选参数（数组）
Route::view('/welcome','welcome');

//定义路由参数
Route::get('user/{id}',function($id){
    return 'User '.$id;
});

//定义多个参数
Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
});

//可选参数  参数后加上“?” 参数必须有默认值
Route::get('user/{name?}', function ($name = 'John Doe') {
    return $name;
});

//正则表达式约束
Route::get('user/{name}',function($name){
    //
})->where('name','[A-Za-z]+');


//路由命名,路由命名必须唯一
Route::get('user/profile',function($name){
    //
})->name('profile');

//指定控制器行为的路由名称
Route::get('photo',PhotoController::class,'show')->name('photo');

////指定路由名称后可以使用route进行链接和重定向
//$url = route('profile');
//return redirect()->route('profile');

//定义参数的命名路由可以将参数作为route函数的第二个参数  指定的参数将会自动插入到 URL 中对应的位置
Route::get('user/{id}/profile',function ($id){})->name('profile');
$url = route('profile',['id'=>1]);

//在数组中传递额外的参数，这些键或值将自动添加到生成的 URL 的查询字符串中
Route::get('user/{id}/profile',function ($id){})->name('profile');
$url = route('profile',['id'=>1]);


//给路由组中所有的路由分配中间件，可以在 group 之前调用 middleware 方法
Route::middleware(['first', 'second'])->group(function () {
   Route::get('/',function(){
       //使用'first'和 'second'的中间件
   });
   Route::get('user/profile',function(){
       //使用'first'和 'second'的中间件
   });
});

//子域名路由   在定义 group 之前调用 domain 方法来指定子域名
Route::domain('{account}.myapp.com')->group(function () {
   Route::get('user/{id}',function($account,$id){
       //
   });
});

//路由前缀  prefix
Route::prefix('admin')->group(function () {
    Route::get('users',function(){
        // Matches The "/admin/users" URL
    });
});

//路由名称前缀
Route::name('admin.')->group(function () {
    Route::get('users',function(){
        // Route assigned name "admin.users"
    })->name('users');
});


//路由与模型绑定
Route::get('api/users/{user}',function (App\Models\User $user){
    return $user->email;
});

//隐式绑定
Route::get('users/{user}', [UserController::class, 'show']);

//回退路由
Route::fallback(function(){
    //定义一个在没有其他路由可匹配传入的请求时才执行的路由
});


//    限流器 限制给定的路由或一组路由的流量
RateLimiter::for('global', function (Request $request) {
    return Limit::perMinute(1000);
});

//自定义 超频请求的响应内容
RateLimiter::for('global', function (Request $request) {
    return Limit::perMinute(1000)->response(function () {
        return response('Custom response...', 429);
    });
});

//使用 $request 实例调取参数，如 user () 来进行身份验证从而自定义请求频率的大小或是否限制
RateLimiter::for('uploads', function (Request $request) {
//    请求当前用户对象是否为VIP客户
    return $request->user()->vipCustomer()
//        如果没有限制
        ? Limit::none()
//        每分钟限制用户的访问次数为 100 次
        : Limit::perMinute(100);
});

//范围频率限制
RateLimiter::for('uploads', function (Request $request) {
    return $request->user()->vipCustomer()
        ? Limit::none()
//        VIP 用户无限制，不是 VIP 的用户每个 IP 每分钟只能请求 100 次
        : Limit::perMinute(100)->by($request->ip());
});

//数组形式增加多个限制
RateLimiter::for('uploads', function (Request $request) {
    return [
        Limit::perMinute(100),
        Limit::perMinute(3)->by($request->input()),
    ];
});


//给路由配置频率限制器
Route::middleware(['throttle:uploads'])->group(function () {
    Route::post('audio',function (){
        //
    });
    Route::post('video',function (){
        //
    });
});

//访问当前路由
$route = Route::current();
$name = Route::currentRouteName();
$action = Route::currentRouteAction();

//url，show方法
Route::get('user/{id}',[UserController::class,'show']);

//中间件 可以在路由文件中分配给控制器的路由    拦截器，访问profile之前需要通过auth文件
Route::get('profile', [UserController::class, 'show'])->middleware('auth');

//单行为控制器不需要指定方法
Route::get('user/{id}',[\App\Http\Controllers\ShowProfile::class]);

//资源控制器路由
//这个单一的路由声明创建了多个路由来处理资源上的各种行为
Route::resource('photo', PhotoController::class);


//一次性的创建多个资源控制器：
Route::resources([
    'photo' => PhotoController::class,
    'user' => UserController::class,
]);

//处理部分行为
Route::resource('photo', PhotoController::class)->only(['index', 'show']);
Route::resource('photo', PhotoController::class)->except(['create', 'store', 'update', 'destroy']);

//使用apiResource方法自动排除create和edit
Route::apiResource('photo', PhotoController::class);

//使用apiResources同时创建多个资源控制器
Route::apiResources([
    'photo' => PhotoController::class,
    'user' => UserController::class,
]);

//嵌套资源
Route::resource('photo.comments', PhotoController::class);

//命名资源路由,覆盖默认名称
Route::resource('photo.comments', PhotoController::class)->names(['create'=> 'photo.build']);

//命名资源路由参数
Route::resource('users', \App\Http\Controllers\AdminUserController::class)->parameters([
    'users' => 'admin_user'
]);
