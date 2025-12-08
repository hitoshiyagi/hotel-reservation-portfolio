@extends('layouts.admin_base')

@section('title', '部屋タイプ管理')

{{-- ヘッダー左側の2段構成を定義 --}}
@section('page_breadcrumb')

{{-- 上段: ページタイトル --}}
<span class="header-page-title">部屋タイプ管理</span>

{{-- 下段: 戻るリンク --}}

<a href="#" class="header-back-link">
    <i class="fas fa-arrow-left me-2"></i> 管理者メニューに戻る
</a>
@endsection

{{-- メインコンテンツエリアにコンテンツを挿入 --}}
@section('content')

{{-- 登録成功メッセージの表示 --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fs-5 m-0">部屋タイプ一覧</h2>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> 新規追加
    </a>
</div>

{{-- 部屋タイプカードのループ --}}
<div>
    @forelse ($rooms as $room)
    {{-- 部屋タイプ全体を囲むコンテナ --}}
    <div class="d-flex mb-4 p-0 shadow-lg mx-auto" style="background-color: #2b2b3a; max-width: 880px; border-radius: 8px;">
        {{-- 1. 画像エリア (幅を固定) --}}
        <div style="flex-shrink: 0; width: 200px; height: 200px; overflow: hidden; border-radius: 8px 0 0 8px;">
            @if (isset($room->image_url) && $room->image_url)
            {{-- 実際には画像URLが存在しないため、ここでは仮の画像を設定 --}}
            <img src="{{ $room->image_url }}" alt="{{ $room->type_name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
            {{-- プレースホルダー画像 (和室と特別室の画像URLを仮に使用) --}}
            @if ($room->type_name == '特別室')
            <img src="https://images.unsplash.com/photo-1719710708080-9e8c98fc62c0?q=80&w=2350&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="特別室" style="width: 100%; height: 100%; object-fit: cover;">
            @else
            <img src="https://images.unsplash.com/photo-1719710708080-9e8c98fc62c0?q=80&w=2350&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="和室" style="width: 100%; height: 100%; object-fit: cover;">
            @endif
            @endif
        </div>

        {{-- 2. テキストコンテンツエリア --}}
        <div class="p-4 flex-grow-1">
            <h5 class="fw-bold mb-1">{{ $room->type_name }}</h5>
            <p class="text-white-75 mb-3 small" style="line-height: 1.4;">{{ $room->description }}</p>

            <div class="d-flex align-items-center mt-3">
                <span class="text-white-50 me-4">
                    <i class="fas fa-user-friends me-1"></i> 定員{{ $room->capacity }}名
                </span>
                <span class="text-primary fw-bold fs-5">
                    ¥{{ number_format($room->price) }}/泊
                </span>
            </div>
        </div>

        {{-- 3. アクションボタンエリア (縦に並んだ専用エリア) --}}
        <div class="d-flex flex-column justify-content-center p-2" style="background-color: #383845; border-radius: 0 8px 8px 0; width: 80px;">

            {{-- 編集ボタン --}}
            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm text-white mb-2" style="background-color: #44445c; border: none; font-size: 0.9rem;">
                <i class="fas fa-pencil-alt d-block mx-auto mb-1"></i> 編集
            </a>

            {{-- 削除ボタン --}}
            {{-- 削除フォームは後ほど実装（ここではボタンのみ） --}}
            <button type="button" class="btn btn-sm text-white" style="background-color: #dc3545; border: none; font-size: 0.9rem;">
                <i class="fas fa-trash-alt d-block mx-auto mb-1"></i> 削除
            </button>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-secondary text-center" role="alert" style="background-color: #383845; border-color: #4a4a58;">
            <i class="fas fa-exclamation-circle me-2"></i> まだ部屋タイプが登録されていません。新規追加してください。
        </div>
    </div>
    @endforelse
</div>

@endsection