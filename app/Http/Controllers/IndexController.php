<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    // 用于首页的显示
    public function index()
    {
        return view('index');
    }
}
