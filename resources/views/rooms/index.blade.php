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

<div class="d-flex align-items-center">
    <a href="{{ route('rooms.create') }}" class="btn btn-primary ms-auto">
        <i class="fas fa-plus me-1"></i> 新規追加
    </a>
</div>

<div>
    @forelse ($rooms as $room)
    <div class="d-flex flex-column flex-md-row m-4 p-0 shadow-lg mx-auto overflow-hidden"
        style="background-color: #2b2b3a; max-width: 880px; border-radius: 8px;">

        {{-- 1. 画像エリア --}}
        <div class="room-card-image flex-shrink-0 position-relative" style="background-color: #383845;">
            @if ($room->primary_image_url)
            <img src="{{ $room->primary_image_url }}"
                alt="{{ $room->type_name }}"
                style="width: 100%; height: 100%; object-fit: cover;">
            @else
            <div class="d-flex align-items-center justify-content-center h-100">
                <i class="fas fa-image fa-3x text-white-50"></i>
            </div>
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

        {{-- 3. アクションボタンエリア --}}
        <div class="room-action-area d-flex justify-content-center align-items-center p-2 gap-2"
            style="background-color: #383845; width: 100px; flex-shrink: 0;">


            {{-- 編集ボタン --}}
            <a href="{{ route('rooms.edit', $room->id) }}"
                class="btn btn-sm text-white w-100"
                style="background-color: #44445c; border: none; font-size: 0.9rem;">
                <i class="fas fa-pencil-alt mb-1 d-inline-block d-md-block mx-auto"></i>
                <span class="d-inline d-md-block">編集</span>
            </a>

            {{-- 削除ボタン --}}
            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                onsubmit="return confirm('{{ $room->type_name }} を削除してもよろしいですか？');"
                class="w-100">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="btn btn-sm text-white w-100"
                    style="background-color: #dc3545; border: none; font-size: 0.9rem;">
                    <i class="fas fa-trash-alt mb-1 d-inline-block d-md-block mx-auto"></i>
                    <span class="d-inline d-md-block">削除</span>
                </button>
            </form>
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