<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>アカウント作成 | 高級旅館予約システム</title>
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
            padding: 40px 20px;
            margin: 0;
        }

        /* アカウント作成カード */
        .register-card {
            width: 100%;
            max-width: 550px;
            /* 入力項目が多いためログインより少し幅広に設定 */
            background: #fff;
            padding: 50px 40px;
            box-shadow: var(--card-shadow);
            border-top: 4px solid var(--ryokan-gold);
        }

        .brand-section {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-section i {
            color: var(--ryokan-deep-green);
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .brand-section h1 {
            font-size: 1.25rem;
            letter-spacing: 0.1em;
            color: var(--ryokan-deep-green);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .brand-section p {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.85rem;
            color: #888;
        }

        .form-label {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.85rem;
            color: #555;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 0;
            border: 1px solid #e0e0e0;
            padding: 11px 15px;
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--ryokan-gold);
            box-shadow: none;
            background-color: #fffcf8;
        }

        /* 登録ボタン */
        .btn-register {
            background-color: var(--ryokan-deep-green);
            color: #fff;
            border: none;
            border-radius: 0;
            padding: 15px;
            width: 100%;
            font-size: 1rem;
            letter-spacing: 0.2em;
            transition: 0.3s;
            margin-top: 20px;
        }

        .btn-register:hover {
            background-color: #3d6354;
            color: #fff;
            transform: translateY(-2px);
        }

        /* エラーエリア */
        .error-area {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.8rem;
            background-color: #fff5f5;
            border-left: 3px solid #dc3545;
            color: #dc3545;
            padding: 15px;
            margin-bottom: 30px;
        }

        .login-link {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.85rem;
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #eee;
        }

        .login-link a {
            color: var(--ryokan-gold);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .input-group-text {
            background-color: transparent;
            border-radius: 0;
            border-right: none;
            color: #aaa;
        }

        .has-icon .form-control {
            border-left: none;
        }
    </style>
</head>

<body>

    <div class="register-card">
        <div class="brand-section">
            <i class="fas fa-hotel"></i>
            <h1>アカウント作成</h1>
            <p>ご登録後、すぐにご予約いただけます</p>
        </div>

        {{-- エラー表示 --}}
        @if ($errors->any())
        <div class="error-area">
            <ul class="mb-0 list-unstyled">
                @foreach ($errors->all() as $error)
                <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="row g-3">
                <div class="col-12 mb-3">
                    <label class="form-label">お名前</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="宿 太郎" required>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">電話番号</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="09012345678" required>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">メールアドレス</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="example@ryokan.jp" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">パスワード <small class="text-muted">(8文字以上)</small></label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">パスワード（確認）</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-register">
                アカウントを登録する
            </button>
        </form>

        <div class="login-link">
            <p class="text-muted mb-0">すでにアカウントをお持ちの方は<br>
                <a href="{{ route('user.login.form') }}">こちらのログインページへ</a>
            </p>
        </div>
    </div>

</body>

</html>