<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //展示个人中心的页面
    public function home()
    {
        $num = DB::table('links')
            ->where('user_id', auth()->id())
            ->count();  //当前用户已使用的链接数量
        return view('user.home',['num' => $num]);
    }

    //展示修改信息的页面
    public function setting_info()
    {
        return view('user.setting_info');
    }

    //向服务器发送修改信息的请求
    public function info_update(Request $request)
    {
        //获取传入的值
        $new_name = $request->input('new_name');
        $new_email = $request->input('new_email');

        if(empty($new_email) || empty($new_name))
        {
            return back()->withErrors('名字或邮箱不能为空');
        }

        $id = auth()->id(); //用户的数据库ID

        //更新数据库
        DB::table('users')
            ->where('id',$id)
            ->update(['name'=>$new_name, 'email'=>$new_email]);
        
        return back()->with(['success'=>'更新成功']);
    }

    //展示修改密码的页面
    public function setting_password()
    {
        return view('user.setting_password');
    }

    //向服务器发送修改密码的请求
    public function password_update(Request $request)
    {
        $id = auth()->id(); //用户的数据库ID
        $old_password = $request->input('old_password');    //传入的原始密码
        $origin_password = DB::table('users')
            ->where('id', $id)
            ->value('password');    //获取数据库中的密码
        if(!Hash::check($old_password, $origin_password))
        {
            return back()->withErrors('密码错误');
        }

        //判断新密码是否符合要求
        $request->validate([
            'password' => ['confirmed', Password::min(8)]
        ]);

        $password = $request->input('password');

        //更新数据库
        DB::table('users')
            ->where('id',$id)
            ->update(['password'=>Hash::make($password)]);
        
        return back()->with(['success'=>'更新成功']);
    }
}
