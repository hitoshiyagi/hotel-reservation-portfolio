<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>常磐ノ杜 | 静寂を愉しむ、大人の隠れ宿</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300;400;600&family=Noto+Sans+JP:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ryokan-deep-green: #2d4a3e;
            --ryokan-light-green: #5a7d6a;
            --ryokan-gold: #b8a485;
            --ryokan-beige: #f5f1eb;
            --ryokan-cream: #faf9f7;
            --text-color: #333;
            --heading-color: #2a2a2a;
        }

        body {
            font-family: 'Noto Serif JP', serif;
            color: var(--text-color);
            line-height: 1.8;
            background-color: var(--ryokan-cream);
            overflow-x: hidden;
            /* 横スクロール防止 */
        }

        /* ヘッダーナビゲーション */
        .header-nav {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }

        .header-nav .navbar-brand {
            font-family: 'Noto Serif JP', serif;
            font-weight: 600;
            color: var(--ryokan-deep-green);
            font-size: 1.5rem;
            letter-spacing: 0.1em;
            display: flex;
            align-items: center;
        }

        .header-nav .navbar-brand i {
            color: var(--ryokan-gold);
            margin-right: 8px;
            font-size: 1.2em;
        }

        .header-nav .nav-link {
            font-family: 'Noto Sans JP', sans-serif;
            color: var(--ryokan-deep-green);
            margin: 0 15px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }

        .header-nav .nav-link::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -5px;
            width: 0;
            height: 2px;
            background-color: var(--ryokan-gold);
            transition: width 0.3s ease-out;
        }

        .header-nav .nav-link:hover::after,
        .header-nav .nav-link.active::after {
            width: 100%;
        }

        .header-nav .nav-link:hover {
            color: var(--ryokan-gold);
        }

        .header-nav .nav-link.active {
            color: var(--ryokan-gold);
        }

        .header-nav .btn-outline-success {
            color: var(--ryokan-deep-green);
            border-color: var(--ryokan-deep-green);
            border-radius: 0;
            padding: 8px 20px;
            font-family: 'Noto Sans JP', sans-serif;
            transition: all 0.3s;
        }

        .header-nav .btn-outline-success:hover {
            background-color: var(--ryokan-deep-green);
            color: #fff;
        }

        /* ヒーローセクション */
        .hero-section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            overflow: hidden;
            padding-top: 80px;
            /* ヘッダーの高さ分 */
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: brightness(0.7);
            /* 少し暗くして文字を見やすく */
        }

        .hero-content {
            z-index: 1;
            max-width: 900px;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-family: 'Noto Serif JP', serif;
            font-size: 4.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            letter-spacing: 0.15em;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        }

        .hero-content p {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 40px;
            text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.3);
            line-height: 1.6;
        }

        .hero-btn {
            background-color: var(--ryokan-gold);
            color: var(--ryokan-deep-green);
            border: none;
            border-radius: 0;
            padding: 18px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .hero-btn:hover {
            background-color: #d1b48b;
            color: var(--ryokan-deep-green);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        /* 共通セクションスタイル */
        .section-padding {
            padding: 196px 0;
        }

        .section-title {
            font-family: 'Noto Serif JP', serif;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--heading-color);
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 15px;
            letter-spacing: 0.05em;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            width: 80px;
            height: 3px;
            background-color: var(--ryokan-gold);
        }

        .section-subtitle {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 80px;
            /* タイトル・説明文からコンテンツまでの距離を少し広げました */
            line-height: 1.6;
        }

        /* コンセプトセクション */
        .concept-section {
            background-color: #fff;
        }

        .concept-text {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.05rem;
            color: #444;
            line-height: 2;
        }

        /* 施設紹介セクション */
        .features-section {
            background-color: var(--ryokan-beige);
        }

        .feature-card {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: transform 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .feature-card:hover {
            transform: translateY(-8px);
        }

        .feature-card i {
            font-size: 3rem;
            color: var(--ryokan-gold);
            margin-bottom: 25px;
        }

        .feature-card h3 {
            font-family: 'Noto Serif JP', serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--heading-color);
            margin-bottom: 20px;
        }

        .feature-card p {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.95rem;
            color: #555;
            line-height: 1.8;
        }

        .feature-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* ギャラリーセクション */
        .gallery-section {
            background-color: var(--ryokan-cream);
        }

        .gallery-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .gallery-img:hover {
            transform: scale(1.02);
        }

        /* CTAセクション */
        .cta-section {
            background: var(--ryokan-deep-green);
            color: #fff;
            text-align: center;
        }

        .cta-section .section-title {
            color: #fff;
        }

        .cta-section .section-title::after {
            background-color: var(--ryokan-gold);
        }

        .cta-section .section-subtitle {
            color: #e0e0e0;
        }

        /* フッター */
        .footer-section {
            background-color: #222;
            color: #aaa;
            padding: 60px 0 30px;
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.9rem;
        }

        .footer-section h5 {
            font-family: 'Noto Serif JP', serif;
            color: #fff;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .footer-section .footer-brand {
            font-family: 'Noto Serif JP', serif;
            font-weight: 600;
            color: #fff;
            font-size: 1.6rem;
            letter-spacing: 0.1em;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .footer-section .footer-brand i {
            color: var(--ryokan-gold);
            margin-right: 10px;
            font-size: 1.2em;
        }

        .footer-section a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: var(--ryokan-gold);
        }

        .social-icons a {
            font-size: 1.5rem;
            margin-right: 15px;
            color: #888;
        }

        .social-icons a:hover {
            color: #fff;
        }

        .copyright {
            margin-top: 40px;
            border-top: 1px solid #333;
            padding-top: 25px;
            font-size: 0.8rem;
            color: #777;
        }

        /* レスポンシブ対応 */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 3rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 0.9rem;
            }

            .hero-btn {
                padding: 15px 30px;
                font-size: 1rem;
            }

            .section-padding {
                padding: 60px 0;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .section-subtitle {
                font-size: 0.9rem;
                margin-bottom: 40px;
            }

            .feature-card {
                margin-bottom: 30px;
            }

            .header-nav .nav-link {
                margin: 0 10px;
            }

            .header-nav .navbar-nav {
                text-align: center;
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>

    {{-- ヘッダーナビゲーション --}}
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="container-fluid container-xl">
            <a class="navbar-brand" href="#">
                <i class="fas fa-tree"></i> 常磐ノ杜
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#hero">ホーム</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#concept">常磐ノ杜とは</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">施設案内</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">ギャラリー</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-lg-3" href="#contact">アクセス</a>
                    </li>
                </ul>
                <a href="{{ route('booking.create') }}" class="btn btn-outline-success">ご予約はこちら</a>
            </div>
        </div>
    </nav>

    {{-- ヒーローセクション --}}
    <section id="hero" class="hero-section">
        <img src="https://i.postimg.cc/zvgcmDFP/travel-4959716-1920.jpg" alt="常磐ノ杜の美しい景色" class="hero-bg">
        <div class="hero-content">
            <h1>常磐ノ杜</h1>
            <p>深い緑に抱かれ、時を忘れる。<br>大人だけの隠れ宿で、真の贅沢をご体験ください。</p>
            <a href="{{ route('booking.create') }}" class="btn hero-btn">ご予約はこちら</a>
        </div>
    </section>

    {{-- コンセプトセクション --}}
    <section id="concept" class="concept-section section-padding">
        <div class="container text-center">
            <h2 class="section-title">常磐ノ杜が誘う、非日常の静寂</h2>
            <p class="section-subtitle">
                深く豊かな森が育む、永遠の緑。常磐ノ杜は、日常の喧騒から隔絶された、大人だけが許された隠れ宿です。<br>
                五感を研ぎ澄まし、自然と一体となる極上の時間をお過ごしください。
            </p>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <p class="concept-text">
                        当館は「大人のための静寂」をコンセプトに、全てのお客様に心ゆくまで寛いでいただけるよう、きめ細やかなおもてなしを追求しております。お子様連れのお客様はご遠慮いただいておりますので、何卒ご了承ください。四季折々の表情を見せる森の息吹を感じながら、大切な方との語らい、あるいはただひたすらに自分と向き合う。そんな贅沢な時間をお約束いたします。
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 施設紹介セクション --}}
    <section id="features" class="features-section section-padding">
        <div class="container text-center">
            <h2 class="section-title">五感を潤す、滞在の悦び</h2>
            <p class="section-subtitle">
                自然の恵みと職人の技が織りなす、極上の体験。常磐ノ杜でしか味わえない、特別なひとときをお届けします。
            </p>
            <div class="row g-4 mt-5">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div>
                            <img src="https://i.postimg.cc/cJfyjGwb/premium5.jpg" alt="客室" class="feature-img">
                            <h3>全室スイート仕様の客室</h3>
                            <p>
                                全室が趣の異なるスイート。窓からは深緑の森を望み、天然素材を活かした設えが五感を優しく包み込みます。プライベートな空間で心ゆくまでお寛ぎください。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div>
                            <img src="https://i.postimg.cc/Gh1Cc6TF/buddy-an-g-Wptqbkqm1I-unsplash.jpg" alt="料理" class="feature-img">
                            <h3>旬を味わう、会席料理</h3>
                            <p>
                                地元の旬の食材を惜しみなく使用した、滋味豊かな会席料理。熟練の料理人が腕を振るい、器から盛り付けまで美意識を凝らした一皿をご堪能いただけます。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div>
                            <img src="https://i.postimg.cc/vZFcwPbj/26554551-s.jpg" alt="温泉" class="feature-img">
                            <h3>源泉かけ流しの露天風呂</h3>
                            <p>
                                森の囁きに耳を傾けながら、天然温泉を心ゆくまでお愉しみください。日頃の疲れを癒し、体の芯から温まる至福のひとときをお約束いたします。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ギャラリーセクション --}}
    <section id="gallery" class="gallery-section section-padding">
        <div class="container text-center">
            <h2 class="section-title">美景を巡る、常磐ノ杜</h2>
            <p class="section-subtitle">
                訪れるたびに新たな表情を見せる、常磐ノ杜の豊かな自然と洗練された空間をご覧ください。
            </p>
            <div class="row g-3 mt-5">
                <div class="col-md-4">
                    <img src="https://i.postimg.cc/SKcF5bCP/premium4.jpg" alt="ギャラリー1" class="gallery-img">
                </div>
                <div class="col-md-4">
                    <img src="https://i.postimg.cc/hGVWwRTZ/premium3.jpg" alt="ギャラリー2" class="gallery-img">
                </div>
                <div class="col-md-4">
                    <img src="https://i.postimg.cc/fyMQv9Nr/nature-3162389-640.jpg" alt="ギャラリー3" class="gallery-img">
                </div>
                <div class="col-md-4">
                    <img src="https://i.postimg.cc/nztyHDMw/nature-4955817-640.jpg" alt="ギャラリー4" class="gallery-img">
                </div>
                <div class="col-md-4">
                    <img src="https://i.postimg.cc/XJ8z41RZ/maple-5311992-640.jpg" alt="ギャラリー5" class="gallery-img">
                </div>
                <div class="col-md-4">
                    <img src="https://i.postimg.cc/wMrFjC05/japanese-garden-3669155-640.jpg" alt="ギャラリー6" class="gallery-img">
                </div>
            </div>
        </div>
    </section>

    {{-- CTAセクション --}}
    <section id="contact" class="cta-section section-padding">
        <div class="container text-center">
            <h2 class="section-title">ご予約はこちらから</h2>
            <p class="section-subtitle">
                日常を忘れ、心ゆくまで寛ぐ。常磐ノ杜で、かけがえのない時間をお過ごしください。
            </p>
            <a href="{{ route('booking.create') }}" class="btn hero-btn mt-4">ご予約ページへ進む</a>
        </div>
    </section>

    {{-- フッター --}}
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <a class="footer-brand" href="#">
                        <i class="fas fa-tree"></i> 常磐ノ杜
                    </a>
                    <p>
                        深い緑に抱かれ、時を忘れる。<br>
                        大人だけの隠れ宿で、真の贅沢をご体験ください。
                    </p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>サイトマップ</h5>
                    <ul class="list-unstyled">
                        <li><a href="#hero">ホーム</a></li>
                        <li><a href="#concept">常磐ノ杜とは</a></li>
                        <li><a href="#features">施設案内</a></li>
                        <li><a href="#gallery">ギャラリー</a></li>
                        <li><a href="#contact">アクセス・お問い合わせ</a></li>
                        <li><a href="{{ route('booking.create') }}">宿泊予約</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>お問い合わせ</h5>
                    <p>
                        〒XXX-XXXX 東京都奥多摩町常磐 XXX<br>
                        TEL: 03-XXXX-XXXX<br>
                        Email: info@tokiwanomori.jp
                    </p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="row copyright text-center">
                <div class="col-12">
                    &copy; 2023 常磐ノ杜. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>