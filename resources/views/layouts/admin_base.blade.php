<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '管理画面') | 宿泊予約管理システム</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --admin-bg-dark: #1c1c24;
            --admin-header-bg: #282834;
            --admin-text-light: #f8f9fa;
            --admin-primary: #175dfc;
        }

        body {
            background-color: var(--admin-bg-dark);
            color: var(--admin-text-light);
            min-height: 100vh;
        }

        .admin-header {
            background-color: var(--admin-header-bg);
            border-bottom: 1px solid #3d3d4a;
            padding: 1rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* ヘッダー内のナビゲーションエリア (左側: 2段構成の親要素) */
        .header-nav-area {
            color: var(--admin-text-light);
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        /* 戻るリンク (上段) */
        .header-back-link {
            display: inline-flex;
            align-items: center;
            color: var(--admin-text-light) !important;
            text-decoration: none;
            opacity: 0.7;
            font-size: 0.85rem;
            margin-bottom: 3px;
        }

        .header-back-link:hover {
            opacity: 1;
        }

        /* ページタイトル (下段) */
        .header-page-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .btn-primary {
            background-color: var(--admin-primary);
            border-color: var(--admin-primary);
        }

        .admin-content {
            padding: 30px;
        }

        .card {
            background-color: var(--admin-header-bg);
            color: var(--admin-text-light);
            border: 1px solid #3d3d4a;
        }
    </style>

    @stack('styles')
</head>

<body>

    <header class="admin-header sticky-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">

                <div class="header-nav-area">
                    {{-- 子ビューがこのセクションで戻るリンクとタイトルを挿入します --}}
                    @yield('page_breadcrumb')
                </div>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="POST" action="#">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">ログアウト</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container-fluid admin-content">

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>