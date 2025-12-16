<?php

use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;


// ==============================
// 管理画面ルーティング
// ==============================

// --- user top（ユーザー入口） ---
// ◯◯◯◯を表示する







// --- admin top（管理者入口） ---
// 予約一覧を真っ先に表示する








// --- reservations（担当：坂野） ---
// http://127.0.0.1:8000/admin/reservations







// --- rooms（担当：矢木） ---
// http://127.0.0.1:8000/admin/rooms

Route::prefix('admin/rooms')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('admin.rooms.index');
    Route::get('create', [RoomController::class, 'create'])->name('admin.rooms.create');
    Route::post('/', [RoomController::class, 'store'])->name('admin.rooms.store');

    Route::get('{room}', [RoomController::class, 'show'])->name('admin.rooms.show');
    Route::get('{room}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::match(['put', 'patch'], '{room}', [RoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('{room}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
});