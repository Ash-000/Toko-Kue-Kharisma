<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Semua Ulasan - Toko Kue Kharisma</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    @include('partials.font-styles')
    <style>
        .container {
            max-width: 900px;
            margin: 50px auto;
            margin-top: 120px;
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
            .container { padding: 0 20px; margin-top: 100px; }
        }
    </style>
    @include('partials.auto-hide-navbar')
</head>
<body style="overflow-x: hidden !important; max-width: 100vw !important; margin: 0 !important;">
    @include('partials.header', ['showBackButton' => true, 'backUrl' => '/'])

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

    {{-- Bottom Navigation (Mobile) --}}
    @include('partials.bottom-nav')
</body>
</html>
