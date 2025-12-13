<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\AdminLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// アカウント登録
Route::get('/register', [RegisterController::class, 'show'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// ユーザーログイン
Route::get('/login', [UserLoginController::class, 'show'])->name('user.login.form');
Route::post('/login', [UserLoginController::class, 'login'])->name('user.login');

//// ログイン後の仮画面表示
Route::get('/user/dashboard', function () {
    if (!session()->has('user_id')) {
        return redirect('/login');
    }

    return view('user.dashboard');
});

//// ログアウト処理（仮）
Route::get('/user/logout', function () {
    session()->flush(); // 全セッションを削除
    return redirect('/login');
});

// 管理者ログイン
Route::get('/admin/login', [AdminLoginController::class, 'show'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

//// ログイン後の仮画面表示
Route::get('/admin/dashboard', function () {
    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    return view('admin.dashboard');
});

//// ログアウト処理（仮）
Route::get('/admin/logout', function () {
    session()->flush(); // 全セッションを削除
    return redirect('/admin/login');
});
