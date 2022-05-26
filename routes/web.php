<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
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

// Route::get('/welcome', function () {
//     return view('welcome');
// });

//显示首页
Route::get('/',[IndexController::class,'index'])->name('index');

Route::prefix('user')->group(function(){
    Route::get('/home',[UserController::class,'home'])
    ->name('user.home');

    Route::get('/setting/username',[UserController::class,'setting_username'])
        ->name('user.setting.username');
    
    Route::post('/setting/username',[UserController::class,'username_update'])
        ->name('user.username.update');

    Route::get('/setting/password',[UserController::class,'setting_password'])
        ->name('user.setting.password');

    Route::post('/setting/password',[UserController::class,'password_update'])
        ->name('user.password.update');

    Route::get('/setting/email',[UserController::class,'setting_email'])
        ->name('user.setting.email');

    Route::post('/setting/email',[UserController::class,'email_update'])
        ->name('user.email.update');
});

Route::get('links/{id}', [LinkController::class, 'get_link'])->where(['id'=>'[0-9]+']);

//用于链接的控制器，包括查看所有链接、创建新链接、发送新链接至服务器、删除链接
Route::resource('links', LinkController::class)->except(['show', 'update','edit']);

Route::get('login/page',function(){
    return view('login');
})->name('login');

Route::get('register/page',function(){
    return view('register');
})->name('register');