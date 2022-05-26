<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //展示个人中心的页面
    public function home()
    {
        return view('user.home');
    }

    //展示修改用户名的页面
    public function setting_username()
    {
        return view('user.setting_username');
    }

    //向服务器发送修改用户名的请求
    public function username_update()
    {
        dd('修改用户名');
    }

    //展示修改密码的页面
    public function setting_password()
    {
        return view('user.setting_password');
    }

    //向服务器发送修改密码的请求
    public function password_update()
    {
        dd('修改密码');
    }

    //展示修改邮箱的页面
    public function setting_email()
    {
        return view('user.setting_email');
    }

    //向服务器发送修改邮箱的请求
    public function email_update()
    {
        dd('修改邮箱');
    }
}
