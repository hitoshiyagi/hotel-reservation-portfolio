<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>常磐ノ杜｜ログイン</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap & Google Fonts --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300;600&family=Noto+Sans+JP:wght@300;400&display=swap" rel="stylesheet">

    <style>
        :root {
            --ryokan-deep-green: #2d4a3e;
            --ryokan-gold: #b8a485;
            --ryokan-beige: #f5f1eb;
            --ryokan-background: #faf9f7;
            --card-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        body {
            font-family: 'Noto Serif JP', serif;
            background-color: var(--ryokan-background);
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        /* ログインカード */
        .login-card {
            width: 100%;
            max-width: 450px;
            background: #fff;
            padding: 50px 40px;
            box-shadow: var(--card-shadow);
            border-top: 4px solid var(--ryokan-gold);
        }

        .login-brand {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-brand i {
            color: var(--ryokan-deep-green);
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .login-brand h1 {
            font-size: 1.25rem;
            letter-spacing: 0.1em;
            color: var(--ryokan-deep-green);
            font-weight: 600;
        }

        .form-label {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 0;
            border: 1px solid #e0e0e0;
            padding: 12px;
            font-family: 'Noto Sans JP', sans-serif;
        }

        .form-control:focus {
            border-color: var(--ryokan-gold);
            box-shadow: none;
        }

        /* ログインボタン */
        .btn-login {
            background-color: var(--ryokan-deep-green);
            color: #fff;
            border: none;
            border-radius: 0;
            padding: 14px;
            width: 100%;
            font-size: 1rem;
            letter-spacing: 0.2em;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #3d6354;
            color: #fff;
            transform: translateY(-2px);
        }

        /* エラー・成功メッセージ */
        .error-area {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.8rem;
            background-color: #fff5f5;
            border-left: 3px solid #dc3545;
            color: #dc3545;
            padding: 15px;
            margin-bottom: 25px;
        }

        .success-area {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.8rem;
            background-color: #f0f7f4;
            border-left: 3px solid var(--ryokan-deep-green);
            color: var(--ryokan-deep-green);
            padding: 15px;
            margin-bottom: 25px;
        }

        /* テストアカウント情報 */
        .test-account-box {
            background-color: var(--ryokan-beige);
            padding: 20px;
            margin-top: 30px;
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.75rem;
            color: #777;
        }

        .test-account-box strong {
            color: var(--ryokan-deep-green);
            display: block;
            margin-bottom: 5px;
        }

        .register-link {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.85rem;
            text-align: center;
            margin-top: 30px;
        }

        .register-link a {
            color: var(--ryokan-gold);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-brand">
            <h1><i class="fas fa-tree"></i> 常磐ノ杜　ログイン</h1>
        </div>

        {{-- エラー表示 --}}
        @if ($errors->any())
        <div class="error-area">
            <ul class="mb-0 list-unstyled">
                @foreach ($errors->all() as $error)
                <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- 成功メッセージ --}}
        @if (session('success'))
        <div class="success-area">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}">
            @csrf

            <div class="mb-4">
                <label class="form-label">メールアドレス</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label">パスワード</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-login">
                ログイン
            </button>

            {{-- デモ用アカウント情報 --}}
            <div class="test-account-box">
                <strong>【テストユーザー用アカウント】</strong>
                <div>メールアドレス: user@example.com</div>
                <div>パスワード: user1234</div>
            </div>
        </form>

        <div class="register-link">
            <p class="text-muted mb-0">アカウントをお持ちでない方は<br>
                <a href="{{ route('register.form') }}">新規会員登録はこちら</a>
            </p>
        </div>
    </div>

</body>

</html>