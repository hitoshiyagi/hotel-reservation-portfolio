@extends('layouts.admin_base') {{-- 共通の親レイアウトを継承 --}}

@section('title', '新規部屋タイプ追加')

{{-- 1. ヘッダー左側の2段構成を定義 --}}
@section('page_breadcrumb')

{{-- 上段: 戻るリンク --}}
<a href="#" class="header-back-link">
    <i class="fas fa-arrow-left me-2"></i> 部屋タイプ管理に戻る
</a>

{{-- 下段: ページタイトル --}}
<span class="header-page-title">新規部屋タイプ追加</span>

@endsection

{{-- 2. メインコンテンツエリアにフォームを挿入 --}}
@section('content')

<div class="card p-4 mx-auto" style="max-width: 800px;">

    <h2 class="h4 mb-4 text-white-75">新しい部屋タイプの詳細</h2>

    {{-- フォームの開始: rooms.store ルートに POST 送信します --}}
    <form method="POST" action="{{ route('rooms.store') }}">
        @csrf

        {{-- 部屋タイプ名 --}}
        <div class="mb-3">
            <label for="name" class="form-label">部屋タイプ名</label>
            <input type="text" class="form-control" id="name" name="name" required style="background-color: #383845; color: var(--admin-text-light); border: 1px solid #4a4a58;">
        </div>

        {{-- 説明 --}}
        <div class="mb-3">
            <label for="description" class="form-label">説明</label>
            <textarea class="form-control" id="description" name="description" rows="3" required style="background-color: #383845; color: var(--admin-text-light); border: 1px solid #4a4a58;"></textarea>
        </div>

        <div class="row">
            {{-- 料金 (price) --}}
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">料金 (JPY)</label>
                <input type="number" class="form-control" id="price" name="price" required min="1" style="background-color: #383845; color: var(--admin-text-light); border: 1px solid #4a4a58;">
            </div>

            {{-- 定員 (capacity) --}}
            <div class="col-md-6 mb-3">
                <label for="capacity" class="form-label">定員 (名)</label>
                <input type="number" class="form-control" id="capacity" name="capacity" required min="1" style="background-color: #383845; color: var(--admin-text-light); border: 1px solid #4a4a58;">
            </div>
        </div>

        <div class="row">
            {{-- 合計部屋数 (total_rooms) --}}
            <div class="col-md-6 mb-3">
                <label for="total_rooms" class="form-label">合計部屋数</label>
                <input type="number" class="form-control" id="total_rooms" name="total_rooms" required min="1" style="background-color: #383845; color: var(--admin-text-light); border: 1px solid #4a4a58;">
            </div>

            {{-- タイプ (premium/standard) --}}
            <div class="col-md-6 mb-3">
                <label for="type" class="form-label">タイプ</label>
                <select class="form-select" id="type" name="type" required style="background-color: #383845; color: var(--admin-text-light); border: 1px solid #4a4a58;">
                    <option value="premium">プレミアム</option>
                    <option value="standard">スタンダード</option>
                </select>
            </div>
        </div>

        {{-- 画像URL (imageUrl) --}}
        <div class="mb-4">
            <label for="imageUrl" class="form-label">画像URL</label>
            <input type="url" class="form-control" id="imageUrl" name="imageUrl" style="background-color: #383845; color: var(--admin-text-light); border: 1px solid #4a4a58;">
            <div class="form-text text-white-50">部屋の魅力が伝わる画像のURLを入力してください。</div>
        </div>

        {{-- 登録ボタン --}}
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save me-2"></i> 部屋タイプを登録
            </button>
        </div>
    </form>
</div>

@endsection