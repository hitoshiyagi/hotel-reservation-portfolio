<?php

use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MemberController;

//仮のログイン画面用
use App\Http\Controllers\SimpleLoginController;


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


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. トップページ (LP) ---
Route::get('/', function () {
    return view('index');
})->name('home');

/*========================================
 ユーザー
 =======================================*/

// --- login ---
Route::get('/register', [RegisterController::class, 'show'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// ユーザーログイン (2つの名前で定義してエラーを防止)
Route::get('/login', [UserLoginController::class, 'show'])
    ->name('user.login.form')
    ->name('login');
Route::post('/login', [UserLoginController::class, 'login'])->name('user.login');

// ログイン後の仮画面表示
Route::get('/user/dashboard', function () {
    if (!session()->has('user')) {
        return redirect()->route('user.login.form');
    }
    return view('user.dashboard');
});

// --- 予約システム ---

// 【修正】予約フォーム表示：手動でログインチェックを行い、未ログインならログイン画面へ
// 予約フォーム表示（手動チェック）
Route::get('/booking/create', function () {
    if (!session()->has('user')) {
        // 名前を使わず、URLで直接ログイン画面へ
        return redirect('/login');
    }
    return app(App\Http\Controllers\BookingController::class)->create(request());
})->name('booking.create');

// 予約一覧
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');

// 予約保存
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

// 予約キャンセル
Route::delete('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

// 予約完了
Route::get('/booking/complete', [BookingController::class, 'complete'])->name('booking.complete');

// 会員管理
Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');

// 【修正】共通ログアウト処理：セッションをクリアしてLPへリダイレクト
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    session()->flush(); // 手作りセッションも削除
    return redirect()->route('home'); // LPに戻る
})->name('logout');


/*========================================
 管理者
 =======================================*/

// --- login ---
// 管理者ログイン（外）
Route::get('/admin/login', [AdminLoginController::class, 'show'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

// 管理者ログイン（中）
Route::middleware('admin')->group(function () {

    // ログイン後の入口
    Route::get('/admin/dashboard', function () {
        return redirect()->route('admin.reservations.index');
    });


    // --- reservations ---
    Route::prefix('admin/reservations')->group(function () {

        Route::get('/', [AdminReservationController::class, 'index'])
            ->name('admin.reservations.index');

        Route::get('{reservation}/edit', [AdminReservationController::class, 'edit'])
            ->name('admin.reservations.edit');

        Route::put('{reservation}', [AdminReservationController::class, 'update'])
            ->name('admin.reservations.update');

        Route::delete('{reservation}', [AdminReservationController::class, 'destroy'])
            ->name('admin.reservations.destroy');
    });


    // --- rooms ---
    Route::prefix('admin/rooms')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('admin.rooms.index');
        Route::get('create', [RoomController::class, 'create'])->name('admin.rooms.create');
        Route::post('/', [RoomController::class, 'store'])->name('admin.rooms.store');

        Route::get('{room}', [RoomController::class, 'show'])->name('admin.rooms.show');
        Route::get('{room}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
        Route::put('{room}', [RoomController::class, 'update'])->name('admin.rooms.update');
        Route::delete('{room}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
    });


    //// ログアウト処理（仮）
    Route::post('/admin/logout', function () {
        session()->flush(); // 全セッションを削除
        return redirect('/admin/login');
    })->name('admin.logout');

});




