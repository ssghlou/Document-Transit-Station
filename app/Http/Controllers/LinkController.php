<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    /**
     * 显示当前用户的所有链接
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('links.index');
    }

    /**
     * 新链接的创建页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * 新链接发送到服务器
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->files;
        dd($file);
    }

    /**
     * 从服务器删除这个链接
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('删除链接');
    }

    /**
     * 进入别人发布的链接
     */
    public function get_link($id)
    {
        dd('进入别人发布的链接'.$id);
    }
}
