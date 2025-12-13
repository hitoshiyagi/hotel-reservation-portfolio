@extends('layouts.admin_base')

@section('title', '部屋タイプ管理')

@section('page_breadcrumb')
<span class="header-page-title">部屋タイプ一覧</span>
<a href="#" class="header-back-link">
    <i class="fas fa-arrow-left me-2"></i> 管理者メニューに戻る
</a>
@endsection


@section('content')

{{-- 登録成功メッセージの表示 --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="d-flex justify-content-end align-items-center mb-4">
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> 新規追加
    </a>
</div>

{{-- ★★★ 新しいグリッドレイアウトの開始 ★★★ --}}
<div class="row g-4"> {{-- rowとg-4 (gap) でグリッドを構成 --}}
    @forelse ($rooms as $room)

    {{-- PCでは2列 (col-md-6)、タブレット以上で3列にしたい場合はcol-lg-4など調整 --}}
    <div class="col-md-6">

        {{-- カード本体 --}}
        <div class="card shadow-lg h-100 overflow-hidden"
            style="background-color: #2b2b3a; border-radius: 8px;">

            {{-- 画像コンテナ (高さ固定) --}}
            <div class="position-relative" style="height: 250px;">

                {{-- メイン画像 (1枚目) --}}
                <div style="height: 100%; width: 100%; position: relative;">
                    @php
                    $primaryImageUrl = $room->images->first()->image_url ?? null;
                    @endphp
                    @if ($primaryImageUrl)
                    <img src="{{ $primaryImageUrl }}"
                        alt="{{ $room->type_name }}"
                        style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: #383845;">
                        <i class="fas fa-image fa-4x text-white-50"></i>
                    </div>
                    @endif
                </div>
            </div>

            {{-- カード本体コンテンツ --}}
            <div class="p-3">
                <h3 class="fs-5 fw-bold mb-1 text-white">{{ $room->type_name }}</h3>

                {{-- 補助情報 (定員と料金) --}}
                <div class="d-flex justify-content-between align-items-center mb-2 pt-1 border-bottom border-secondary pb-2">
                    <span class="text-white-50">
                        <i class="fas fa-user-friends me-1"></i> 定員{{ $room->capacity }}名
                    </span>
                    <span class="text-primary fw-bold fs-5">
                        ¥{{ number_format($room->price) }}/泊
                    </span>
                </div>

                {{-- サムネイルエリア (2枚目以降を表示) --}}
                <div class="d-flex gap-2 mb-3">
                    @php
                    // 2枚目から5枚目までを取得 (最大4枚)
                    $thumbnails = $room->images->skip(1)->take(4);
                    $maxThumbnails = 4;
                    @endphp

                    @foreach ($thumbnails as $image)
                    {{-- サムネイルのサイズを調整して4枚並べる --}}
                    <img src="{{ $image->image_url }}"
                        alt="サムネイル"
                        style="width: 48px; height: 48px; object-fit: cover; border-radius: 4px; border: 1px solid #4a4a58;">
                    @endforeach

                    {{-- 画像が4枚に満たない場合のプレースホルダー --}}
                    @for ($i = $thumbnails->count(); $i < $maxThumbnails; $i++)
                        <div style="width: 48px; height: 48px; background-color: #383845; border-radius: 4px; border: 1px dashed #4a4a58;">
                </div>
                @endfor
            </div>
            {{-- 説明文 (短く表示) --}}
            <p class="text-white-75 small mb-3" style="line-height: 1.4; height: 40px; overflow: hidden;">
                {{ $room->description }}
            </p>
        </div>

        {{-- アクションボタンエリア --}}
        <div class="p-3 pt-0 d-flex gap-2 mt-auto" style="background-color: #383340;">

            {{-- ★★★ 1. 詳細ボタン（最も目立たせる） ★★★ --}}
            <a href="{{ route('rooms.show', $room->id) }}"
                class="btn btn-sm btn-primary flex-grow-1"
                style="border: none; font-size: 0.9rem;">
                <i class="fas fa-eye me-1"></i> 詳細を見る
            </a>

            {{-- 2. 編集ボタン（固定幅） --}}
            <a href="{{ route('rooms.edit', $room->id) }}"
                class="btn btn-sm text-white"
                style="background-color: #44445c; border: none; font-size: 0.9rem; width: 80px;">
                <i class="fas fa-pencil-alt me-1"></i> 編集
            </a>

            {{-- 3. 削除ボタン（固定幅） --}}
            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                onsubmit="return confirm('{{ $room->type_name }} を削除してもよろしいですか？');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="btn btn-sm text-white"
                    style="background-color: #dc3545; border: none; font-size: 0.9rem; width: 80px;">
                    <i class="fas fa-trash-alt me-1"></i> 削除
                </button>
            </form>
        </div>
    </div>
</div>
@empty
{{-- 部屋がない場合のメッセージ (グリッド外) --}}
<div class="col-12">
    <div class="alert alert-secondary text-center" role="alert" style="background-color: #383845; border-color: #4a4a58;">
        <i class="fas fa-exclamation-circle me-2"></i> まだ部屋タイプが登録されていません。新規追加してください。
    </div>
</div>
@endforelse
</div>
@endsection