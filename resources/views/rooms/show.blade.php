@extends('layouts.admin_base')

@section('title', $room->type_name . ' - 詳細')

@section('page_breadcrumb')
<span class="header-page-title">{{ $room->type_name }} の詳細</span>
<a href="{{ route('rooms.index') }}" class="header-back-link">
    <i class="fas fa-arrow-left me-2"></i> 部屋タイプ管理に戻る
</a>
@endsection

@section('content')

<div class="card p-4 mx-auto" style="max-width: 1000px; background-color: #2b2b3a;">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
        <h2 class="h4 text-white fw-bold">{{ $room->type_name }}</h2>

        {{-- 編集ボタン --}}
        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">
            <i class="fas fa-pencil-alt me-1"></i> 編集
        </a>
    </div>

    {{-- ★★★ 1. 画像ギャラリーエリア (最大5枚対応) ★★★ --}}
    @php
    $images = $room->images->values(); // キーをゼロベースにリセット
    $hasImages = $images->isNotEmpty();
    @endphp

    <div class="mb-4">
        @if ($hasImages)
        {{-- メイン画像 (1枚目) --}}
        <div class="mb-3 overflow-hidden rounded" style="height: 450px; background-color: #383845;">
            <img id="main-image"
                src="{{ $images->first()->image_url ?? '' }}"
                alt="メイン画像"
                style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;">
        </div>

        {{-- サムネイルギャラリー --}}
        <div class="d-flex gap-2 overflow-x-auto pb-1">
            @foreach ($images->take(5) as $image)
            <img class="thumbnail-image rounded"
                src="{{ $image->image_url }}"
                alt="サムネイル {{ $loop->iteration }}"
                data-full-url="{{ $image->image_url }}"
                style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 2px solid {{ $loop->first ? 'var(--bs-primary)' : 'transparent' }}; opacity: {{ $loop->first ? '1' : '0.8' }}; transition: all 0.2s;">
            @endforeach
        </div>
        @else
        <div class="d-flex align-items-center justify-content-center mb-3 rounded" style="height: 300px; background-color: #383845;">
            <i class="fas fa-image fa-5x text-white-50"></i>
            <p class="text-white-50 ms-3">登録画像なし</p>
        </div>
        @endif
    </div>

    {{-- ★★★ 2. 詳細情報エリア ★★★ --}}
    <div class="row mb-4">
        {{-- 左側: 主要情報 --}}
        <div class="col-md-6">
            <h5 class="text-white-75 mb-3"><i class="fas fa-tag me-2"></i> 料金と基本情報</h5>
            <table class="table table-dark table-striped" style="background-color: #383845 !important;">
                <tbody>
                    <tr>
                        <th style="width: 40%;">料金 (1泊)</th>
                        <td class="fw-bold text-primary fs-5">¥{{ number_format($room->price) }}</td>
                    </tr>
                    <tr>
                        <th>定員</th>
                        <td><i class="fas fa-user-friends me-1"></i> {{ $room->capacity }} 名</td>
                    </tr>
                    <tr>
                        <th>総部屋数</th>
                        <td>{{ $room->total_rooms }} 室</td>
                    </tr>
                    <tr>
                        <th>作成日</th>
                        <td>{{ $room->created_at->format('Y/m/d H:i') }}</td>
                    </tr>
                    <tr>
                        <th>最終更新日</th>
                        <td>{{ $room->updated_at->format('Y/m/d H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- 右側: 説明文 --}}
        <div class="col-md-6">
            <h5 class="text-white-75 mb-3"><i class="fas fa-info-circle me-2"></i> 部屋タイプの説明</h5>
            <div class="p-3 rounded" style="background-color: #383845;">
                <p class="text-white mb-0" style="white-space: pre-wrap;">{{ $room->description }}</p>
            </div>
        </div>
    </div>

    {{-- 戻るボタン --}}
    <div class="text-center mt-3">
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary btn-lg" style="width: 250px;">
            <i class="fas fa-undo me-2"></i> 一覧に戻る
        </a>
    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('main-image');
        const thumbnails = document.querySelectorAll('.thumbnail-image');

        if (!mainImage) return;

        // サムネイルクリック時の処理
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newUrl = this.dataset.fullUrl;
                mainImage.src = newUrl;

                // 選択されたサムネイルの枠線を強調し、他のサムネイルの枠線をリセット
                thumbnails.forEach(t => {
                    t.style.borderColor = 'transparent';
                    t.style.opacity = '0.8';
                });
                this.style.borderColor = 'var(--bs-primary)';
                this.style.opacity = '1';
            });
        });

        // 初回ロード時に1枚目のサムネイルに枠線を適用
        if (thumbnails.length > 0) {
            thumbnails[0].style.borderColor = 'var(--bs-primary)';
            thumbnails[0].style.opacity = '1';
        }
    });
</script>
@endpush