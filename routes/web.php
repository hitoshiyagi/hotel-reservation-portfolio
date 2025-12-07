<?php

use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
// rooms 担当：矢木
Route::prefix('rooms')->group(function () {
    // 1. Index (一覧表示) - GET /rooms
    // メソッド: GET
    // URI: /rooms
    // アクション: RoomController@index
    Route::get('/', [RoomController::class, 'index'])->name('rooms.index');

    // 2. Create (作成フォーム表示) - GET /rooms/create
    // メソッド: GET
    // URI: /rooms/create
    // アクション: RoomController@create
    Route::get('create', [RoomController::class, 'create'])->name('rooms.create');

    // 3. Store (データ登録) - POST /rooms
    // メソッド: POST
    // URI: /rooms
    // アクション: RoomController@store
    Route::post('/', [RoomController::class, 'store'])->name('rooms.store');

    // 4. Show (詳細表示) - GET /rooms/{room}
    // メソッド: GET
    // URI: /rooms/{room}
    // アクション: RoomController@show
    // {room} は、Roomモデルのインスタンスを自動で注入するためのルートパラメーターです（ルートモデルバインディング）。
    Route::get('{room}', [RoomController::class, 'show'])->name('rooms.show');

    // 5. Edit (編集フォーム表示) - GET /rooms/{room}/edit
    // メソッド: GET
    // URI: /rooms/{room}/edit
    // アクション: RoomController@edit
    Route::get('{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');

    // 6. Update (データ更新) - PUT/PATCH /rooms/{room}
    // メソッド: PUT/PATCH
    // URI: /rooms/{room}
    // アクション: RoomController@update
    Route::match(['put', 'patch'], '{room}', [RoomController::class, 'update'])->name('rooms.update');

    // 7. Destroy (データ削除) - DELETE /rooms/{room}
    // メソッド: DELETE
    // URI: /rooms/{room}
    // アクション: RoomController@destroy
    Route::delete('{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
});
