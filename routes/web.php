<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */

// // Route::get('/welcome', function () {
// //     return view('welcome');
// // });

//显示首页
Route::get('/',[IndexController::class,'index'])->name('index');

Route::prefix('user')->group(function(){
    Route::get('/home',[UserController::class,'home'])
    ->name('user.home')->middleware(['auth']);

    Route::get('/setting/info',[UserController::class,'setting_info'])
        ->name('user.setting.info')->middleware(['auth']);
    
    Route::post('/setting/info',[UserController::class,'info_update'])
        ->name('user.info.update')->middleware(['auth']);

    Route::get('/setting/password',[UserController::class,'setting_password'])
        ->name('user.setting.password')->middleware(['auth']);

    Route::post('/setting/password',[UserController::class,'password_update'])
        ->name('user.password.update')->middleware(['auth']);
});

Route::get('links/s/{id}', [LinkController::class, 'get_link'])->middleware(['auth']);

//用于链接的控制器，包括查看所有链接、创建新链接、发送新链接至服务器、删除链接
Route::resource('links', LinkController::class)->except(['show', 'update','edit'])->middleware(['auth']);


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
