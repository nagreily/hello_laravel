<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

//路由（Routes）：路由定义了用户请求的 URL 与应用程序中的具体操作之间的映射关系。在 Laravel 中，您可以在 routes/web.php 文件中定义路由，
//指定请求的 URL 对应的控制器方法。例如，您可以使用 Route::get('/welcome', 'WelcomeController@index');
//来定义一个 GET 请求的路由，将请求交给 WelcomeController 控制器的 index 方法处理。
//
//控制器（Controllers）：控制器负责处理应用程序的业务逻辑，接收用户请求并返回响应。
//在 Laravel 中，控制器通常存放在 app/Http/Controllers 目录下，您可以通过 Artisan 命令来生成控制器。
//控制器中的方法可以通过路由调用，处理用户请求并返回视图或数据。例如，您可以在控制器中使用 return view('welcome', ['name' => $name]);来渲染 Blade 模板并传递数据。
//
//Blade 模板（Views）：Blade 是 Laravel 中的模板引擎，用于构建视图文件并将动态数据渲染到页面上。
//Blade 模板文件通常存放在 resources/views 目录下，您可以在控制器中使用 return view('welcome', ['name' => $name]); 来加载并渲染指定的 Blade 模板。
//在 Blade 模板中，您可以使用 Blade 的语法来嵌入 PHP 代码、循环、条件语句等，以动态生成页面内容。
//



//服务容器  是指：通过构造函数，或者某些情况下通过「setter」方法将类依赖「注入」到类中
class UserController1 extends Controller
{
    /**
     * user仓储的实现
     *
     * @var UserRepository
     */
    protected $users;

//    此处就是使用构造函数将UserRepository的方法注入到ServiceContainerController中
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }



    public function show(int $id)
    {
        $user = $this->users->find($id);
        return view('user.profile', ['user' => $user]);
    }
}
