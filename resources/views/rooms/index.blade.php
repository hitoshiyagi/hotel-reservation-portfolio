@extends('layouts.admin_base')

@section('title', '宿泊予約管理システム')
{{-- タイトルを変更してください --}}

{{-- ヘッダー左側の2段構成を定義 --}}
@section('page_breadcrumb')

{{-- 上段: 戻るリンク --}}
<span class="header-page-title">部屋タイプ管理</span>

{{-- 下段: ページタイトル --}}

<a href="#" class="header-back-link">
    <i class="fas fa-arrow-left me-2"></i> 管理者メニューに戻る
</a>
@endsection

{{-- メインコンテンツエリアにコンテンツを挿入 --}}
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fs-5 m-0">部屋タイプ一覧</h2>
    <a href="#" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> 新規追加
    </a>
</div>

<div class="card p-4 mb-3">
    <p>ここに部屋のタイプごとに並ぶ。</p>

</div>

<!-- ここまでがコンテンツエリアです -->
@endsection