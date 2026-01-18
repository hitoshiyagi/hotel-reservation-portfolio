@extends('layouts.booking')

@section('content')
<style>
    :root {
        --ryokan-deep-green: #2d4a3e;
        --ryokan-gold: #b8a485;
        --ryokan-beige: #f5f1eb;
    }

    .bg-finish-pattern {
        background-color: #f8f9fa;
        min-height: 90vh;
        display: flex;
        align-items: center;
    }

    .card-finish {
        border: none;
        border-radius: 0;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .finish-header {
        background-color: var(--ryokan-deep-green);
        color: white;
        padding: 3rem 1rem;
    }

    .btn-ryokan-main {
        background-color: var(--ryokan-deep-green);
        color: white;
        border-radius: 0;
        padding: 1rem;
        letter-spacing: 0.1em;
        transition: 0.3s;
    }

    .btn-ryokan-main:hover {
        background-color: #3d6354;
        color: white;
    }

    .btn-ryokan-outline {
        border: 1px solid #ccc;
        border-radius: 0;
        padding: 1rem;
        color: #666;
        letter-spacing: 0.1em;
    }
</style>

<div class="bg-finish-pattern">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card card-finish">
                    {{-- ヘッダー部 --}}
                    <div class="finish-header text-center">
                        <div class="mb-3">
                            <i class="fas fa-check-circle fa-3x" style="color: var(--ryokan-gold);"></i>
                        </div>
                        <h1 class="h4 fw-bold mb-2">ご予約を承りました</h1>
                        <p class="small mb-0 opacity-75">Reservation Completed</p>
                    </div>

                    {{-- ボディ部 --}}
                    <div class="card-body p-4 p-md-5">
                        <p class="text-center text-muted small mb-4">
                            この度はご予約いただき誠にありがとうございます。<br>
                            ご来館をスタッフ一同、心よりお待ち申し上げております。
                        </p>

                        @if(session('booking'))
                        <div class="bg-light p-3 border mb-4">
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">予約番号</span>
                                <span class="fw-bold">#{{ session('booking.id') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">お部屋タイプ</span>
                                <span class="fw-bold">{{ session('booking.room_name') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">チェックイン</span>
                                <span class="fw-bold">{{ session('booking.check_in') }}</span>
                            </div>
                            <hr class="my-2 opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">合計料金</span>
                                <span class="h5 mb-0 fw-bold" style="color: var(--ryokan-deep-green);">
                                    ¥{{ number_format(session('booking.total_price')) }}
                                </span>
                            </div>
                        </div>
                        @endif

                        {{-- アクションボタン --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('booking.index') }}" class="btn btn-ryokan-main shadow-sm">
                                <i class="fas fa-list me-2"></i>予約状況を確認する
                            </a>
                            <a href="/" class="btn btn-ryokan-outline mt-2">
                                TOPページへ戻る
                            </a>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="text-muted" style="font-size: 0.75rem;">
                                ※予約確認メールをご登録のアドレスへ送信いたしました。<br>
                                届かない場合は、お手数ですが施設までお電話ください。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection