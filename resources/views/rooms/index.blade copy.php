@extends('layouts.admin_base')

@section('title', '部屋タイプ管理')

{{-- 💡 ヘッダー左側の2段構成を定義 --}}
@section('page_breadcrumb')

{{-- 上段: 戻るリンク --}}
<a href="{{ route('admin.menu') }}" class="header-back-link">
    <i class="fas fa-arrow-left me-2"></i> 管理者メニューに戻る
</a>

{{-- 下段: ページタイトル --}}
<span class="header-page-title">部屋タイプ管理</span>

@endsection

{{-- 💡 メインコンテンツエリアにコンテンツを挿入 --}}
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white-50 fs-5 m-0">部屋タイプ一覧</h2>
    <a href="{{ route('admin.room_types.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> 新規追加
    </a>
</div>

<div class="card p-4 mb-3">
    <p>ここでは、特別室、和室などのカード形式の部屋タイプ一覧が表示されます。</p>
</div>

@endsection