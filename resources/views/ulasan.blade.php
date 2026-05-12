<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Ulasan - Toko Kue Kharisma</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #f5deb3 0%, #f4d4a8 100%);
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
            padding: 15px clamp(15px, 4vw, 50px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header-left { display: flex; align-items: center; gap: 20px; }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.3);
            border: none;
            padding: 8px 15px;
            border-radius: 10px;
            color: #2c2c2c;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-back:hover { background: rgba(255,255,255,0.5); transform: translateX(-3px); }

        .btn-back svg { width: 20px; height: 20px; stroke: #2c2c2c; fill: none; stroke-width: 2.5; }

        .store-name {
            font-family: 'Brush Script MT', cursive;
            font-size: 28px;
            color: #2c2c2c;
            font-style: italic;
            font-weight: bold;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c2c2c;
        }

        .total-badge {
            background: #8b7355;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .review-card {
            background: white;
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .review-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 12px;
        }

        .review-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #2c2c2c;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .review-avatar svg {
            width: 28px;
            height: 28px;
            stroke: white;
            fill: none;
            stroke-width: 2;
        }

        .review-info { flex: 1; }

        .review-stars { color: #ffd700; font-size: 16px; margin-bottom: 3px; }

        .review-name {
            font-size: 16px;
            font-weight: 600;
            color: #2c2c2c;
        }

        .review-date {
            font-size: 12px;
            color: #a89f8c;
            margin-top: 2px;
        }

        .review-text {
            color: #4a4a4a;
            font-size: 14px;
            line-height: 1.7;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 20px;
        }

        .empty-state p {
            font-size: 16px;
            color: #8b7355;
            margin-bottom: 20px;
        }

        .btn-back-home {
            display: inline-block;
            background: #8b7355;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-back-home:hover { background: #6b5845; }

        @media (max-width: 768px) {
            header { padding: 15px 20px; }
            .container { padding: 0 20px; }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <a href="/" class="btn-back">
                <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Kembali
            </a>
            <span class="store-name">Toko kue kharisma</span>
        </div>
    </header>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Semua Ulasan</h1>
            <span class="total-badge">{{ $reviews->count() }} ulasan</span>
        </div>

        @forelse($reviews as $review)
        <div class="review-card">
            <div class="review-header">
                <div class="review-avatar">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="review-info">
                    <div class="review-stars">
                        {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                    </div>
                    <div class="review-name">{{ $review->name }}</div>
                    <div class="review-date">{{ $review->created_at->format('d F Y, H:i') }}</div>
                </div>
            </div>
            <p class="review-text">{{ $review->review }}</p>
        </div>
        @empty
        <div class="empty-state">
            <p>Belum ada ulasan. Jadilah yang pertama!</p>
            <a href="/" class="btn-back-home">Kembali ke Beranda</a>
        </div>
        @endforelse
    </div>
</body>
</html>
