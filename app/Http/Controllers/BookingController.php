<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * 予約フォームの表示（ログインチェックは web.php 側で実施済み）
     */
    public function create(Request $request)
    {
        $rooms = Room::all();

        // チェックイン日（未選択は今日）
        $checkInDate = $request->input('check_in_date', now()->toDateString());

        // 各部屋タイプごとに空室判定
        foreach ($rooms as $room) {
            $reservedCount = Reservation::where('room_id', $room->id)
                ->whereDate('check_in', $checkInDate)
                ->where('status', 'confirmed')
                ->count();

            $room->reserved_count = $reservedCount;
            $room->remaining_rooms = max(0, $room->total_rooms - $reservedCount);
            $room->available      = $room->remaining_rooms > 0;
        }

        // --- 【完全版：修正ポイント】ログイン中の予約一覧を取得 ---
        // session('user') がある場合のみ、その ID で絞り込む
        $reservations = session()->has('user')
            ? Reservation::with('room')
            ->where('user_id', session('user')['id'])
            ->orderBy('check_in', 'desc')
            ->get()
            : collect();

        return view('booking.create', compact('rooms', 'reservations', 'checkInDate'));
    }

    /**
     * 予約の保存
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id'       => 'required|exists:rooms,id',
            'guest_count'   => 'required|integer|min:1',
            'check_in_date' => 'required|date|after_or_equal:today',
        ]);

        $room = Room::findOrFail($validated['room_id']);
        $checkOutDate = Carbon::parse($validated['check_in_date'])->addDay();

        // --- 【完全版：修正ポイント】session('user')['id'] を使用 ---
        $reservation = Reservation::create([
            'user_id'     => session('user')['id'], // 手作りログインセッションから取得
            'room_id'     => $validated['room_id'],
            'check_in'    => $validated['check_in_date'],
            'guests'      => $validated['guest_count'],
            'total_price' => $room->price,
            'status'      => 'confirmed',
        ]);

        // 保存後、予約画面に戻り、完了メッセージとデータを渡す
        return redirect('/booking/create')
            ->with('booking_success', 'ご予約が完了いたしました。')
            ->with('booking', [
                'id'            => $reservation->id,
                'room_name'     => $room->type_name,
                'check_in'      => $reservation->check_in->format('Y-m-d'),
                'check_out_date' => $checkOutDate->format('Y-m-d'),
                'guests'        => $reservation->guests,
                'total_price'   => $reservation->total_price,
            ]);
    }

    /**
     * 予約状況の一覧表示（個別ページ用）
     */
    public function index()
    {
        // ここもセッション方式に修正
        $reservations = Reservation::with('room')
            ->where('user_id', session('user')['id'])
            ->orderBy('check_in', 'desc')
            ->get();

        return view('booking.index', compact('reservations'));
    }

    /**
     * 予約のキャンセル
     */
    public function cancel($id)
    {
        // ここもセッション方式で「自分の予約か」をチェック
        $reservation = Reservation::where('id', $id)
            ->where('user_id', session('user')['id'])
            ->firstOrFail();

        $reservation->status = 'cancelled';
        $reservation->save();

        return redirect('/booking/create')
            ->with('booking_success', '予約をキャンセルしました。');
    }

    /**
     * 予約完了画面（もし別途必要なら）
     */
    public function complete()
    {
        return view('booking.complete');
    }
}
