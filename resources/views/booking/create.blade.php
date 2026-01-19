<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>施設コンセプト | 高級旅館予約</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- 外部ライブラリ --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300;600&family=Noto+Sans+JP:wght@300;400&display=swap" rel="stylesheet">

    <style>
        :root {
            --ryokan-deep-green: #2d4a3e;
            --ryokan-light-green: #5a7d6a;
            --ryokan-gold: #b8a485;
            --ryokan-beige: #f5f1eb;
            --ryokan-cream: #faf9f7;
            --background: #faf9f7;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Noto Serif JP', serif;
            background-color: var(--background);
            color: #333;
            line-height: 1.7;
        }

        .container-custom {
            max-width: 1300px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        /* タブデザイン */
        .nav-pills .nav-link {
            border-radius: 0;
            padding: 12px 30px;
            color: #666;
            background: transparent;
            border-bottom: 2px solid transparent;
            font-weight: 500;
        }

        .nav-pills .nav-link.active {
            background: transparent;
            color: var(--ryokan-deep-green);
            border-bottom: 2px solid var(--ryokan-deep-green);
        }

        /* 通知アラート共通 */
        .alert-ryokan {
            background-color: #fff;
            border: none;
            border-left: 5px solid var(--ryokan-deep-green);
            box-shadow: var(--card-shadow);
            border-radius: 0;
            color: #333;
        }

        .alert-ryokan-cancel {
            border-left-color: #dc3545;
            /* キャンセル時は赤 */
        }

        .card-modern {
            border: none;
            border-radius: 0;
            background: #fff;
            box-shadow: var(--card-shadow);
            height: 100%;
        }

        @media (min-width: 992px) {
            .sticky-sidebar {
                position: sticky;
                top: 20px;
            }
        }

        .room-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .room-card {
            background: #fff;
            border: 1px solid #eee;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .room-card.selected {
            border: 2px solid var(--ryokan-gold);
            background: #fffcf8;
        }

        .room-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .room-card .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .room-title {
            font-weight: 600;
            font-size: 1.15rem;
            margin-bottom: 10px;
        }

        .room-price {
            color: var(--ryokan-deep-green);
            font-weight: 600;
        }

        .room-desc {
            font-size: 0.85rem;
            color: #777;
            margin-bottom: 15px;
            font-family: 'Noto Sans JP', sans-serif;
        }

        .detail-view {
            border-top: 4px solid var(--ryokan-gold);
            padding: 40px;
            animation: fadeIn 0.5s ease;
            margin-top: 30px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .thumb-gallery img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.6;
            transition: 0.3s;
            border: 1px solid transparent;
        }

        .thumb-gallery img:hover,
        .thumb-gallery img.active {
            opacity: 1;
            border-color: var(--ryokan-gold);
        }

        .btn-reserve {
            background: var(--ryokan-deep-green);
            color: #fff;
            border: none;
            border-radius: 0;
            padding: 15px;
            transition: 0.3s;
            letter-spacing: 0.1em;
        }

        .btn-reserve:hover {
            background: var(--ryokan-light-green);
            color: #fff;
        }

        .btn-reserve:disabled {
            background: #ccc;
        }

        .price-box {
            background: var(--ryokan-beige);
            padding: 20px;
            margin-bottom: 20px;
        }

        /* ログアウトボタン：ホバーで色を少し薄くする設定 */
        .btn-ryokan-logout {
            background-color: var(--ryokan-deep-green);
            color: #fff;
            border: none;
            /* 枠線を消してスッキリさせます */
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.8rem;
            transition: background-color 0.3s ease;
            /* 色の変化を滑らかに */
        }

        .btn-ryokan-logout:hover {
            /* ホバー時に「ryokan-light-green」へ変化させる */
            background-color: var(--ryokan-light-green);
            color: #fff;
        }

        .btn-outline-secondary {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.8rem;
            border-color: #ccc;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="container-custom">
        {{-- ヘッダー部分 --}}
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                @if(session('user'))
                <span class="text-uppercase small tracking-widest text-muted mb-2 d-block">
                    <i class="fas fa-user-circle me-1"></i>ようこそ　 {{ session('user')['name'] }} 様
                </span>
                @else
                <span class="text-uppercase small tracking-widest text-muted mb-2 d-block">Reservation</span>
                @endif
                <h2 class="mb-0"><i class="fas fa-tree"></i> 常磐ノ杜　宿泊予約</h2>
            </div>

            {{-- 右側のボタンエリア --}}
            <div class="d-flex gap-3 align-items-center">
                {{-- TOPに戻るボタン --}}
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm rounded-0 px-3">
                    <i class="fas fa-home me-1"></i> TOP
                </a>

                {{-- ログアウトボタン（色をグリーンに） --}}
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-ryokan-logout btn-sm rounded-0 px-3">
                        <i class="fas fa-sign-out-alt me-1"></i> LOGOUT
                    </button>
                </form>
            </div>
        </div>
        {{-- タブ制御ロジック：予約(booking) または キャンセル(booking_success) があれば「予約状況」を表示 --}}
        @php
        $showListTab = session('booking') || session('booking_success');
        @endphp

        <ul class="nav nav-pills mb-5 justify-content-center" id="bookingTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link {{ $showListTab ? '' : 'active' }}" id="form-tab" data-bs-toggle="tab" data-bs-target="#form" type="button" role="tab">
                    ご予約フォーム
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link {{ $showListTab ? 'active' : '' }}" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab">
                    予約状況の確認
                </button>
            </li>
        </ul>

        <div class="tab-content" id="bookingTabContent">
            {{-- 1. 予約フォームタブ --}}
            <div class="tab-pane fade {{ $showListTab ? '' : 'show active' }}" id="form" role="tabpanel">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <div class="row g-5">
                        {{-- 左サイドバー：条件入力 --}}
                        <div class="col-lg-4">
                            <div class="sticky-sidebar">
                                <div class="card-modern p-4">
                                    <h4 class="h5 mb-4 border-bottom pb-2">ご宿泊条件</h4>
                                    <div class="mb-4">
                                        <label class="small text-muted mb-2">チェックイン</label>
                                        <input type="date" id="check_in_date" name="check_in_date"
                                            value="{{ request('check_in_date') ?? now()->format('Y-m-d') }}"
                                            min="{{ now()->format('Y-m-d') }}"
                                            onchange="window.location='{{ route('booking.create') }}?check_in_date=' + encodeURIComponent(this.value)"
                                            class="form-control bg-light border-0">
                                    </div>
                                    <div class="mb-4">
                                        <label class="small text-muted mb-2">人数（大人のみ）</label>
                                        <select name="guest_count" id="guest_count" class="form-select bg-light border-0">
                                            @for($i=1; $i<=4; $i++)
                                                <option value="{{ $i }}" {{ $i == 2 ? 'selected' : '' }}>{{ $i }}名様</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="price-box text-center">
                                        <div class="small text-muted mb-1">選択中の合計金額</div>
                                        <div id="totalPrice" class="h3 mb-0">¥0</div>
                                    </div>
                                    <input type="hidden" name="room_id" id="room_id">
                                    <button type="submit" id="reserveBtn" class="btn btn-reserve w-100" disabled
                                        onclick="return confirm('この内容で予約を確定しますか？');">
                                        この内容で予約する
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- 右メイン：部屋選択 --}}
                        <div class="col-lg-8">
                            <h4 class="h5 mb-4 px-2">お部屋を選択してください</h4>
                            <div class="room-list">
                                @foreach($rooms as $room)
                                <div class="room-card"
                                    data-room-id="{{ $room->id }}"
                                    data-price="{{ $room->price }}"
                                    data-description="{{ $room->description }}"
                                    data-name="{{ $room->type_name }}"
                                    data-capacity="{{ $room->capacity }}"
                                    data-images='@json($room->images->map(fn($img) => $img->image_url))'
                                    data-available="{{ $room->available ? '1' : '0' }}">

                                    <img src="{{ $room->images->first()?->image_url ?? asset('images/no-image.png') }}" alt="Room">
                                    <div class="card-body">
                                        <div class="room-title">{{ $room->type_name }}</div>
                                        <div class="room-desc">
                                            <i class="fas fa-user-friends me-1"></i> 定員：{{ $room->capacity }}名<br>
                                            {{ \Illuminate\Support\Str::limit($room->description, 40) }}
                                        </div>
                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <div class="room-price">¥{{ number_format($room->price) }} <small class="text-muted">~</small></div>
                                            @if(!$room->available)
                                            <span class="badge bg-secondary">満室</span>
                                            @else
                                            <span class="small text-success"><i class="fas fa-check"></i> 選択可能</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{-- 動的詳細表示エリア --}}
                            <div id="detailSection" class="card-modern detail-view d-none">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <img id="room_image" src="" alt="Room" class="img-fluid w-100 shadow-sm" style="height: 350px; object-fit: cover;">
                                        </div>
                                        <div id="room_thumbnails" class="thumb-gallery d-flex gap-2 overflow-x-auto"></div>
                                    </div>
                                    <div class="col-md-5">
                                        <h3 id="room_name" class="h4 mb-3" style="color: var(--ryokan-deep-green);"></h3>
                                        <div class="d-flex gap-4 mb-4 pb-3 border-bottom border-light">
                                            <div><small class="text-muted d-block">定員</small><span class="fw-bold"><span id="room_capacity"></span>名</span></div>
                                            <div><small class="text-muted d-block">料金（1泊）</small><span class="fw-bold text-primary" id="room_price"></span></div>
                                        </div>
                                        <p id="room_description" class="text-muted small mb-4" style="white-space: pre-wrap;"></p>
                                        <div class="p-3 bg-light border-start border-4 border-success small text-muted">
                                            <i class="fas fa-info-circle me-1"></i> チェックイン 15:00 / チェックアウト 11:00
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- 2. 予約状況の確認タブ --}}
            <div class="tab-pane fade {{ $showListTab ? 'show active' : '' }}" id="list" role="tabpanel">
                <div class="card-modern p-4">

                    {{-- 【修正】session('booking') がある時だけ、予約完了を表示 --}}
                    @if(session('booking'))
                    <div class="alert alert-ryokan p-4 mb-5 animate__animated animate__fadeIn">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center mb-3 mb-md-0"><i class="fas fa-check-circle fa-3x text-success"></i></div>
                            <div class="col-md-8">
                                <h4 class="h5 fw-bold mb-1" style="color: var(--ryokan-deep-green);">ご予約を承りました</h4>
                                <p class="mb-0 text-muted small">
                                    予約番号: <strong>#{{ session('booking.id') }}</strong> |
                                    お部屋: {{ session('booking.room_name') }}
                                </p>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="alert">閉じる</button>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- 【修正】session('booking_success') がある時だけ、キャンセル完了を表示 --}}
                    {{-- かつ、bookingセッションがないことを条件に加えることで二重表示を防止 --}}
                    @if(session('booking_success') && !session('booking'))
                    <div class="alert alert-ryokan alert-ryokan-cancel p-4 mb-5 animate__animated animate__fadeIn">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center mb-3 mb-md-0"><i class="fas fa-info-circle fa-3x text-danger"></i></div>
                            <div class="col-md-8">
                                <h4 class="h5 fw-bold mb-1 text-danger">キャンセルが完了しました</h4>
                                <p class="mb-0 text-muted small">{{ session('booking_success') }}</p>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="alert">閉じる</button>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- 予約リストテーブル --}}
                    @if ($reservations->isEmpty())
                    <div class="text-center py-5">
                        <p class="text-muted">現在、予約履歴はございません。</p>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr class="small text-muted">
                                    <th>予約ID</th>
                                    <th>お部屋</th>
                                    <th>宿泊日</th>
                                    <th>人数</th>
                                    <th>合計金額</th>
                                    <th>状況</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="small">#{{ $reservation->id }}</td>
                                    <td class="fw-bold">{{ $reservation->room->type_name }}</td>
                                    <td>{{ $reservation->check_in->format('Y/m/d') }}</td>
                                    <td>{{ $reservation->guests }}名</td>
                                    <td>¥{{ number_format($reservation->total_price) }}</td>
                                    <td>
                                        @if ($reservation->status === 'confirmed')
                                        <span class="badge bg-success-subtle text-success px-3">予約確定</span>
                                        @else
                                        <span class="badge bg-danger-subtle text-danger px-3">キャンセル済み</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if ($reservation->status === 'confirmed' && $reservation->check_in->isAfter(now()->endOfDay()))
                                        <form action="{{ route('booking.cancel', $reservation->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-3" onclick="return confirm('本当にキャンセルしますか？')">取消</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 予約またはキャンセル直後、メッセージが見える位置へ自動スクロール
            @if($showListTab)
            const tabsElement = document.getElementById('bookingTabs');
            tabsElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            @endif

            const reserveBtn = document.getElementById('reserveBtn');
            const totalPrice = document.getElementById('totalPrice');
            const roomCards = document.querySelectorAll('.room-card');
            const detailSection = document.getElementById('detailSection');

            function selectRoom(card) {
                if (card.dataset.available === "0") return;

                roomCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');

                const price = parseInt(card.dataset.price);
                const name = card.dataset.name;
                const description = card.dataset.description;
                const capacity = card.dataset.capacity;
                const roomId = card.dataset.roomId;
                const images = JSON.parse(card.dataset.images);

                totalPrice.textContent = '¥' + price.toLocaleString();
                reserveBtn.disabled = false;
                document.getElementById('room_id').value = roomId;

                detailSection.classList.remove('d-none');
                document.getElementById('room_name').textContent = name;
                document.getElementById('room_price').textContent = '¥' + price.toLocaleString();
                document.getElementById('room_description').textContent = description;
                document.getElementById('room_capacity').textContent = capacity;

                const mainImg = document.getElementById('room_image');
                mainImg.src = images.length > 0 ? images[0] : "{{ asset('images/no-image.png') }}";

                const thumbContainer = document.getElementById('room_thumbnails');
                thumbContainer.innerHTML = '';

                if (images.length > 1) {
                    images.forEach((imgUrl, index) => {
                        const thumb = document.createElement('img');
                        thumb.src = imgUrl;
                        thumb.classList.add('rounded');
                        if (index === 0) thumb.classList.add('active');
                        thumb.addEventListener('click', function() {
                            mainImg.src = imgUrl;
                            thumbContainer.querySelectorAll('img').forEach(i => i.classList.remove('active'));
                            thumb.classList.add('active');
                        });
                        thumbContainer.appendChild(thumb);
                    });
                }
            }

            roomCards.forEach(card => card.addEventListener('click', () => selectRoom(card)));

            // 完了通知がない場合のみ、最初の部屋を自動選択
            @if(!$showListTab)
            const firstAvailable = Array.from(roomCards).find(c => c.dataset.available === "1");
            if (firstAvailable) firstAvailable.click();
            @endif
        });
    </script>
</body>

</html>