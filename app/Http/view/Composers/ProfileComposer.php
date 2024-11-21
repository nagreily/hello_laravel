<?php

namespace App\Http\view\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class ProfileComposer
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     *
     * @param  UserRepository  $users
     * @return void
     */
//    构造函数 初始化成员变量
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('count', $this->users->count());
    }
}
