@extends('layouts.booking')

@section('content')
<div class="max-w-screen-2xl mx-auto p-6" style="background-color: #f5f5dc;">

    <!-- ページ名とユーザー名 -->
    <div class="text-center mb-8">
        <h1 class="display-4 fw-bold">一泊限定 高級宿泊施設予約</h1>
        <h2 class="display-6 text-dark mt-2">
          @if(auth()->check())
              ようこそ、{{ Auth::user()->name }}様
          @else
              ようこそ、ゲスト様
          @endif
        </h2>
    </div>

    <!-- タブナビゲーション -->
    <ul class="nav nav-tabs" id="bookingTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="form-tab" data-bs-toggle="tab" data-bs-target="#form" type="button" role="tab">
          予約フォーム
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab">
          予約一覧
        </button>
      </li>
    </ul>

    <!-- タブコンテンツ -->
    <div class="tab-content mt-4" id="bookingTabsContent">

    <!-- 予約フォーム -->
    <div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">
        
    
        {{-- 予約フォーム全体 --}}
        <form action="{{ route('booking.store') }}" method="POST" class="mt-6 grid grid-cols-2 gap-6">
            @csrf

        <div class="row">           
            {{-- 左サイドバー --}}
            <div class="col-md-4">
            <div class="bg-white p-4 rounded shadow">

                {{-- チェックイン日選択 --}}
                <label for="check_in_date">チェックイン日</label>
                <input type="date" id="check_in_date"
                       value="{{ request('check_in_date') ?? now()->format('Y-m-d')}}"
                       min="{{ now()->format('Y-m-d') }}"
                       onchange="window.location='{{ route('booking.create') }}?check_in_date='+this.value"
                       class="form-control">

                {{-- hiddenで選択日を保持（予約確定時に送信される） --}}
                <input type="hidden" name="check_in_date" value="{{ request('check_in_date') ?? now()->format('Y-m-d') }}">

                {{-- 人数入力 --}}
                <label class="mt-4">人数
                    <input type="number" name="guest_count" value="2" max="4" min="1" class="form-control">
                </label>

                {{-- プラン選択 --}}
                <label class="mt-4">プラン
                  <div>
                      <input type="checkbox" name="selected_plans[]" value="breakfast"> 朝食付き (+3000円/人)
                  </div>
                </label>

                {{-- 合計金額 --}}
                <div class="mt-4 p-3 bg-light border rounded">
                    <span class="fw-bold">合計金額:</span>
                    <span id="totalPrice" class="fs-5 text-danger">¥0</span>
                </div>
    
                {{-- 予約確定ボタン(初期は白文字+disabled) --}}
                <button type="submit" class="mt-6 bg-amber-600 text-white px-4 py-2 rounded"
                        id="reserveBtn" disabled>
                    予約確定
                </button>
            </div>
        </div>

        {{-- 右メインエリア --}}
        <div class="col-md-8">
            <div class="row">
                @foreach($rooms as $room)
                
                {{-- 部屋カード(Bootstrapのカードを使用) --}}
                <div class="col-md-6 mb-4">
                    <div class="card flex-fill shadow-sm  {{ !$room->available ? 'opacity-50' : '' }}"
                    style="min-height: 800px; background-color: #fff8dc">
                    
                    {{-- カードヘッダー：部屋タイプ --}}
                    <div class="card-header bg-dark text-white">
                        <h2 class="h-5 mb-0">{{ $room->type_name }}</h2>
                    </div>

                    {{-- カード本文:料金・残り部屋数･選択ラジオボタン--}}
                    <div class="card-body d-flex flex-column justify-cotent-between" style="height: 100%;">

                        {{-- 部屋画像（ダミーURL使用） --}}
                            <img src="https://picsum.photos/400/250?random={{ $room->id }}" 
                                 alt="{{ $room->type_name }}" 
                                 class="img-fluid mb-3 rounded"
                                 style="height: 480px; object-fit: cover; width: 100%;">


                        {{-- 部屋画像（URLから表示）一旦非常時------ 
                        @if($room->image_url)
                            <img src="{{ $room->image_url }}" 
                                 alt="{{ $room->type_name }}" 
                                 class="img-fluid mb-3 rounded"
                                 style="height: 480px; object-fit: cover; width: 100%;">
                        @endif 
                        --------------------------------------}}

                        
                        {{-- 料金の表示 --}}
                        <p class="fs-3 fw-bold mt-3">料金: ¥{{ number_format($room->price) }}</p>

                        <p class="fs-4">残り部屋数: {{ $room->remaining_rooms }} / {{ $room->total_rooms }}</p>

                        {{-- 部屋選択ラジオボタン --}}
                        <div class="form-check d-flex align-items-center mt-3">                       
                            <input class="form-check-input" type="radio" name="room_id" value="{{ $room->id }}"
                                {{ !$room->available ? 'disabled' : '' }}
                                data-price="{{ $room->price }}" 
                                onchange="enableReserveBtn()"
                                style="tranform: scale(1.8); margin-right:0.6rem;">
                         <label class="form-check-label fs-2 fw-bold mb-0">
                            {{ $room->available ? '空室有り' : '満室' }}
                        </label>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
        </form>
</div>

      <!-- 予約一覧 -->
      <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
        @if($reservations->isEmpty())
            <p>現在、予約はありません。</p>
        @else
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">予約ID</th>
                        <th class="border px-4 py-2">部屋タイプ</th>
                        <th class="border px-4 py-2">チェックイン</th>
                        <th class="border px-4 py-2">人数</th>
                        <th class="border px-4 py-2">料金</th>
                        <th class="border px-4 py-2">ステータス</th>
                        <th class="border px-4 py-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td class="border px-4 py-2">booking-{{ $reservation->id }}</td>
                            <td class="border px-4 py-2">{{ $reservation->room->type_name }}</td>
                            <td class="border px-4 py-2">{{ $reservation->check_in->format('Y-m-d') }}</td>
                            <td class="border px-4 py-2">{{ $reservation->guests }}名</td>
                            <td class="border px-4 py-2">¥{{ number_format($reservation->total_price) }}</td>
                            <td class="border px-4 py-2">
                                @if($reservation->status === 'confirmed')
                                    <span class="text-green-600">確定</span>
                                @else
                                    <span class="text-red-600">キャンセル済み</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                @if($reservation->status === 'confirmed')
                                    <form action="{{ route('booking.cancel', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('本当にキャンセルしますか？')" class="bg-red-500 text-white px-3 py-1 rounded">
                                           キャンセル
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
      </div>
    </div>
</div>

<!-- 予約完了モーダル -->
@if(session('booking'))
<div class="modal fade show" id="bookingCompleteModal" tabindex="-1" aria-labelledby="bookingCompleteLabel" aria-hidden="true" style="display:block;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green-600 text-white">
        <h5 class="modal-title" id="bookingCompleteLabel">予約が完了しました！</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
      </div>
      <div class="modal-body">
        <p><strong>予約ID:</strong> booking-{{ session('booking.id') }}</p>
        <p><strong>部屋タイプ:</strong> {{ session('booking.room_name') }}</p>
        <p><strong>チェックイン:</strong> {{ session('booking.check_in') }}</p>
        <p><strong>チェックアウト:</strong> {{ session('booking.check_out_date') }}</p>
        <p><strong>人数:</strong> {{ session('booking.guests') }}名</p>
        <p><strong>料金:</strong> ¥{{ number_format(session('booking.total_price')) }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- モーダルの自動表示用スクリプト -->
@if(session('booking'))
<script>
document.addEventListener("DOMContentLoaded", function() {
    var bookingModal = document.getElementById('bookingCompleteModal');
    var modal = new bootstrap.Modal(bookingModal);
    modal.show();
});
</script>
@endif

{{-- JavaScriptで予約ボタンを有効化＋文字色変更 --}}
<script>
function enableReserveBtn() {
    const btn = document.getElementById('reserveBtn');
    btn.disabled = false;               // ボタンを有効化
    btn.classList.remove('text-white'); // 白文字を削除
    btn.classList.add('text-black');    // 黒文字を追加
}
</script>

{{-- JavaScriptで合計金額を反映させる --}}
<script>
function updateTotalPrice() {
    const guestCount = parseInt(document.querySelector('[name="guest_count"]').value) || 0;
    const breakfast = document.querySelector('[name="selected_plans[]"][value="breakfast"]').checked;
    let basePrice = 0;

    // 選択された部屋の料金を取得
    const selectedRoom = document.querySelector('[name="room_id"]:checked');
    if (selectedRoom) {
        basePrice = parseInt(selectedRoom.dataset.price);
    }

    let total = basePrice;
    if (breakfast) {
        total += 3000 * guestCount;
    }

    document.getElementById('totalPrice').textContent = '¥' + total.toLocaleString();
}

// イベントリスナー
document.querySelectorAll('[name="room_id"], [name="guest_count"], [name="selected_plans[]"]').forEach(el => {
    el.addEventListener('change', updateTotalPrice);
});
</script>

@endsection