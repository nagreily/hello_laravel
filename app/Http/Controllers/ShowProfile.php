<?php


namespace App\Http\Controllers;


//单行为控制器
use App\Models\User;

class ShowProfile extends Controller{
    public function __invoke($id)
    {
        return view('user.profile',['user' => User::findOrFail($id)]);
    }
}
