<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Toko Kue Kharisma - Kue tradisional lezat dari Dramaga, Bogor Barat">
    <title>Toko Kue Kharisma</title>
    <link rel="preconnect" href="https://app.sandbox.midtrans.com">
    <link rel="dns-prefetch" href="https://app.sandbox.midtrans.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    @include('partials.font-styles')
    <style>
        /* Hero Section */
        .hero { position: relative; height: 420px; overflow: hidden; cursor: pointer; width: 100%; }
        .hero-images { display: flex; height: 100%; width: 100%; transition: transform 0.8s ease-in-out; }
        .hero-image { min-width: 100%; width: 100%; height: 100%; background-size: cover; background-position: center; flex-shrink: 0; }
        .slider-nav { position: absolute; top: 0; height: 100%; width: 20%; z-index: 5; cursor: pointer; transition: background 0.3s; }
        .slider-nav:hover { background: rgba(0, 0, 0, 0.1); }
        .slider-nav-left { left: 0; }
        .slider-nav-right { right: 0; }
        .slider-indicators { position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); display: flex; gap: 10px; z-index: 11; }
        .indicator { width: 10px; height: 10px; border-radius: 50%; background: rgba(255, 255, 255, 0.5); cursor: pointer; transition: all 0.3s; }
        .indicator.active { background: white; width: 30px; border-radius: 5px; }

        /* Best Sellers Section */
        .best-sellers { padding: 50px 20px; max-width: 1400px; margin: 0 auto; text-align: center; }
        .section-divider { width: 200px; height: 2px; background: var(--color-brown); margin: 0 auto 40px; }


        /* About Section */
        .about-section {
            background: linear-gradient(135deg, var(--color-bg) 0%, var(--color-bg-alt) 100%);
            padding: 80px 50px;
        }
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .about-content { display: flex; flex-direction: column; gap: 24px; }
        .about-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(139, 115, 85, 0.12);
            color: var(--color-brown);
            font-size: 13px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 50px;
            width: fit-content;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .about-badge svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }
        .about-title {
            font-size: clamp(28px, 4vw, 42px);
            color: var(--color-text);
            line-height: 1.2;
            margin: 0;
        }
        .about-subtitle {
            color: var(--color-brown);
            font-size: 16px;
            line-height: 1.7;
            margin: 0;
        }
        .about-stats {
            display: flex;
            gap: 32px;
            margin-top: 8px;
        }
        .about-stat { display: flex; flex-direction: column; }
        .about-stat-number {
            font-family: 'Lora', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--color-brown-dark);
            line-height: 1;
        }
        .about-stat-label {
            font-size: 13px;
            color: var(--color-text-light);
            margin-top: 4px;
        }
        .about-description {
            color: var(--color-text-mid);
            font-size: 15px;
            line-height: 1.8;
            margin: 0;
            border-left: 3px solid var(--color-brown);
            padding-left: 20px;
        }
        .about-images-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            position: relative;
        }
        .about-image-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            aspect-ratio: 4/5;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        .about-image-card:first-child { margin-top: 40px; }
        .about-image-card:last-child { margin-bottom: 40px; }
        .about-image-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }
        .about-image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .about-deco {
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(139, 115, 85, 0.08);
            z-index: 0;
        }
        .about-deco-1 { top: -20px; right: 40px; }
        .about-deco-2 { bottom: -10px; left: 20px; width: 60px; height: 60px; }

        /* Reviews Section */
        .reviews-section { background: linear-gradient(135deg, var(--color-header) 0%, var(--color-header-end) 100%); padding: 50px; }
        .reviews-header { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto 30px; }
        .add-review-btn {
            background: var(--color-text); color: white; border: none; border-radius: 50%;
            width: 50px; height: 50px; font-size: 24px; cursor: pointer; display: flex;
            align-items: center; justify-content: center; transition: all 0.3s; box-shadow: var(--shadow-sm);
        }
        .add-review-btn:hover { background: #000; transform: scale(1.1); }
        .add-review-text { font-size: 14px; font-weight: 700; color: var(--color-text); margin-left: 15px; }
        .add-review-wrapper { display: flex; align-items: center; }
        
        .reviews-container { max-width: 1200px; margin: 0 auto; display: grid; gap: 20px; }
        .review-card { background: #fafafa; border-radius: 20px; padding: 25px 30px; box-shadow: var(--shadow-sm); }
        .review-header { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .review-avatar { width: 50px; height: 50px; border-radius: 50%; background: var(--color-text); display: flex; align-items: center; justify-content: center; }
        .review-avatar svg { width: 30px; height: 30px; stroke: white; fill: none; stroke-width: 2; }
        .review-info { flex: 1; }
        .review-stars { color: #ffd700; font-size: 16px; margin-bottom: 5px; }
        .review-name { font-size: 16px; font-weight: 700; color: var(--color-text); }
        .review-text { color: var(--color-brown); font-size: 14px; line-height: 1.6; }

        /* Modals & Decorative */
        .not-found-modal, .success-modal, .review-modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6); z-index: 1000; align-items: center; justify-content: center;
        }
        .not-found-modal.active, .success-modal.active, .review-modal.active { display: flex; }
        .not-found-content, .success-modal-content, .modal-content {
            background: white; border-radius: 20px; padding: 40px; max-width: 400px; width: 90%;
            text-align: center; box-shadow: var(--shadow-lg); position: relative; max-height: 90vh; overflow-y: auto;
        }
        
        .not-found-icon, .success-icon {
            width: 80px; height: 80px; margin: 0 auto 20px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .not-found-icon { background: #f5f5f0; }
        .not-found-icon svg { width: 50px; height: 50px; stroke: var(--color-brown); fill: none; stroke-width: 2; }
        .success-icon { background: #e8f5e9; }
        .success-icon svg { width: 50px; height: 50px; stroke: var(--color-green); fill: none; stroke-width: 3; }

        .not-found-title, .success-title, .modal-title { font-size: 22px; font-weight: 700; color: var(--color-text); margin-bottom: 10px; font-family: 'Lora', serif; }
        .not-found-message, .success-message { font-size: 15px; color: var(--color-text-light); margin-bottom: 25px; line-height: 1.5; }
        
        .btn-close-not-found, .btn-submit-review {
            background: var(--color-brown); color: white; border: none; padding: 12px 30px;
            border-radius: 25px; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.3s; width: 100%;
        }
        .btn-close-not-found:hover, .btn-submit-review:hover { background: var(--color-brown-dark); transform: translateY(-2px); }
        .btn-close-success { background: var(--color-green); color: white; border: none; padding: 12px 40px; border-radius: 25px; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.3s; }
        .btn-close-success:hover { background: #388e3c; }

        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .btn-close-modal { background: none; border: none; font-size: 28px; color: var(--color-brown); cursor: pointer; border-radius: 50%; transition: all 0.3s; width: 35px; height: 35px; }
        .btn-close-modal:hover { background: #f5f5f0; color: var(--color-text); }
        
        .rating-label { display: block; font-size: 16px; font-weight: 700; color: var(--color-text-mid); margin-bottom: 10px; text-align: left; }
        .stars-input { display: flex; gap: 10px; font-size: 32px; justify-content: center; margin-bottom: 20px; }
        .star { cursor: pointer; color: #e0e0e0; transition: color 0.2s; }
        .star:hover, .star.active { color: #ffd700; }
        .review-form-group { margin-bottom: 20px; text-align: left; }
        .review-form-group label { display: block; font-size: 14px; font-weight: 700; color: var(--color-text-mid); margin-bottom: 8px; }
        .review-form-control { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; color: var(--color-text); font-family: 'Nunito', sans-serif; }
        .review-form-control:focus { outline: none; border-color: var(--color-brown); }

        /* Animations & Specifics */
        .fade-up { opacity: 0; transform: translateY(30px); transition: all 0.8s ease; }
        .fade-up.show { opacity: 1; transform: translateY(0); }
        .flower-decoration { position: absolute; width: 80px; opacity: 0.6; }
        .flower-left { bottom: 10px; left: 20px; }
        .flower-right { bottom: 10px; right: 20px; }

        @media (max-width: 1024px) {
            .products-grid { grid-template-columns: repeat(3, 1fr); gap: 25px; }
        }
        @media (max-width: 768px) {
            .products-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
            .about-images-wrapper { grid-template-columns: 1fr 1fr; gap: 12px; }
            .about-image-card:first-child { margin-top: 0; }
            .about-image-card:last-child { margin-bottom: 0; }
            .about-deco { display: none; }
            .reviews-header { flex-direction: column; gap: 20px; }
            .hero { height: 350px; }
        }
        @media (max-width: 480px) {
            .hero { height: 250px; }
            .about-section { padding: 50px 20px; }
            .about-container { grid-template-columns: 1fr; gap: 30px; }
            .about-images-wrapper { order: 2; }
            .about-image-card { aspect-ratio: 1/1; }
            .about-stats { gap: 24px; }
            .about-stat-number { font-size: 28px; }
            .reviews-section { padding: 40px 20px; }
        }
    </style>
    @include('partials.auto-hide-navbar')
    @include('partials.enhanced-interactions')
</head>
<body style="overflow-x: hidden !important; max-width: 100vw !important; margin: 0 !important;">
    @include('partials.header')

    <!-- Hero Section -->
    <section class="hero">
        <!-- Navigation Areas -->
        <div class="slider-nav slider-nav-left" onclick="prevSlide()"></div>
        <div class="slider-nav slider-nav-right" onclick="nextSlideManual()"></div>

        <div class="hero-images" id="heroSlider">
            <div class="hero-image" style="background-image: url('/images/products/bolu-pelangi.jpg')"></div>
            <div class="hero-image" style="background-image: url('/images/products/putu-ayu.jpg')"></div>
            <div class="hero-image" style="background-image: url('/images/products/pepe-pelangi.jpg')"></div>
            <div class="hero-image" style="background-image: url('/images/products/lemper.jpg')"></div>
            <div class="hero-image" style="background-image: url('/images/products/dadar-gulung.jpg')"></div>
        </div>

        <div class="slider-indicators" id="sliderIndicators">
            <div class="indicator active" data-slide="0"></div>
            <div class="indicator" data-slide="1"></div>
            <div class="indicator" data-slide="2"></div>
            <div class="indicator" data-slide="3"></div>
            <div class="indicator" data-slide="4"></div>
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section class="best-sellers">
        <h2 class="section-title">Best Sellers</h2>
        <div class="section-divider"></div>

        {{-- Products Grid --}}
        <div class="products-grid">
            @forelse($products as $product)
            <div class="product-card" data-product-id="{{ $product->id }}">
                <div class="product-image-container">
                    @php
                        // Priority: Use images from public/images/products/ folder
                        // Generate image filename from product name
                        $productSlug = \Illuminate\Support\Str::slug($product->name);
                        
                        // Try multiple image extensions
                        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
                        $imageUrl = null;
                        
                        foreach ($extensions as $ext) {
                            $publicImagePath = 'images/products/' . $productSlug . '.' . $ext;
                            if (file_exists(public_path($publicImagePath))) {
                                $imageUrl = asset($publicImagePath);
                                break;
                            }
                        }
                        
                        // Fallback to storage if public image not found
                        if (!$imageUrl && $product->image) {
                            if (str_starts_with($product->image, 'http')) {
                                $imageUrl = $product->image;
                            } elseif (str_starts_with($product->image, 'products/')) {
                                $imageUrl = asset('storage/' . $product->image);
                            } else {
                                $imageUrl = asset('storage/products/' . $product->image);
                            }
                        }
                        
                        // Last fallback - default image
                        if (!$imageUrl) {
                            $imageUrl = asset('images/products/bolu-pelangi.jpg');
                        }
                    @endphp
                    <img src="{{ $imageUrl }}" 
                         alt="{{ $product->name }}" 
                         class="product-image"
                         onerror="this.onerror=null; this.src='{{ asset('images/products/bolu-pelangi.jpg') }}';">
                </div>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    @if($product->description)
                    <p class="product-description">{{ Str::limit($product->description, 60) }}</p>
                    @endif
                    <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="product-actions">
                        <button class="btn-add-cart" 
                                onclick="addToCart(this, {{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
                            Masukkan ke keranjang
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align:center; padding:40px;">
                <p style="color:#8b7355; font-size:16px;">Belum ada produk tersedia</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="about-container">
            <div class="about-content">
                <div class="about-badge">
                    <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    Sejak 2009
                </div>
                <h2 class="about-title">Tentang Kami</h2>
                <p class="about-subtitle">
                    Selamat datang di Toko Kue Kharisma — toko kue yang manis, enak, dan lezat.
                </p>
                <div class="about-stats">
                    <div class="about-stat">
                        <span class="about-stat-number">15+</span>
                        <span class="about-stat-label">Tahun Pengalaman</span>
                    </div>
                    <div class="about-stat">
                        <span class="about-stat-number">20+</span>
                        <span class="about-stat-label">Varian Kue</span>
                    </div>
                </div>
                <p class="about-description">
                    Toko ini berdiri sejak tahun 2009, kami mulai dari dapur kecil dan terus bertumbuh. Toko ini membawa kebahagiaan melalui kue jaman dahulu 
                    yang dibuat dengan cinta.
                </p>
            </div>
            <div class="about-images-wrapper">
                <div class="about-deco about-deco-1"></div>
                <div class="about-deco about-deco-2"></div>
                <div class="about-image-card">
                    <img src="/images/products/bolu-pelangi.jpg" alt="Bolu Pelangi" loading="lazy">
                </div>
                <div class="about-image-card">
                    <img src="/images/products/putu-ayu.jpg" alt="Putu Ayu" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews-section">
        <div class="reviews-header">
            <h2 class="reviews-title">Customer reviews</h2>
        </div>

        <div class="reviews-container">
            @foreach($reviews as $review)
            <div class="review-card">
                <div class="review-header">
                    <div class="review-avatar">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="review-info">
                        <div class="review-stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
                        <div class="review-name">{{ $review->name }}</div>
                        <div style="font-size:12px;color:#a89f8c;margin-top:2px;">{{ $review->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                <p class="review-text">{{ $review->review }}</p>
            </div>
            @endforeach
        </div>

        {{-- Pagination untuk Reviews --}}
        @if($reviews->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $reviews->firstItem() }} - {{ $reviews->lastItem() }} dari {{ $reviews->total() }} ulasan
            </div>
            <div class="pagination-buttons">
                @if($reviews->onFirstPage())
                    <button class="btn-page" disabled>
                        <svg viewBox="0 0 24 24" width="18" height="18">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" fill="none" stroke-width="2"/>
                        </svg>
                        Prev
                    </button>
                @else
                    <a href="{{ $reviews->previousPageUrl() }}" class="btn-page">
                        <svg viewBox="0 0 24 24" width="18" height="18">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" fill="none" stroke-width="2"/>
                        </svg>
                        Prev
                    </a>
                @endif

                <span class="page-numbers">
                    Halaman {{ $reviews->currentPage() }} dari {{ $reviews->lastPage() }}
                </span>

                @if($reviews->hasMorePages())
                    <a href="{{ $reviews->nextPageUrl() }}" class="btn-page">
                        Next
                        <svg viewBox="0 0 24 24" width="18" height="18">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" fill="none" stroke-width="2"/>
                        </svg>
                    </a>
                @else
                    <button class="btn-page" disabled>
                        Next
                        <svg viewBox="0 0 24 24" width="18" height="18">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" fill="none" stroke-width="2"/>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
        @endif

        @if($totalReviews > 10)
        <div style="text-align:center;margin-top:30px;">
            <a href="{{ route('reviews.index') }}" style="
                display: inline-block;
                background: #2c2c2c;
                color: white;
                padding: 12px 35px;
                border-radius: 25px;
                font-size: 15px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s;
            " onmouseover="this.style.background='#000'" onmouseout="this.style.background='#2c2c2c'">
                Lihat Selengkapnya ({{ $totalReviews }} ulasan)
            </a>
        </div>
        @endif
    </section>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Bottom Navigation (Mobile) --}}
    @include('partials.bottom-nav')

    <!-- Review Modal -->
    <div class="review-modal" id="reviewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Tambahkan Ulasan</h2>
                <button class="btn-close-modal" onclick="closeReviewModal()">×</button>
            </div>

            <form onsubmit="submitReview(event)">
                <div class="rating-input">
                    <label class="rating-label">Rating</label>
                    <div class="stars-input" id="starsInput">
                        <span class="star" data-rating="1" onclick="setRating(1)">★</span>
                        <span class="star" data-rating="2" onclick="setRating(2)">★</span>
                        <span class="star" data-rating="3" onclick="setRating(3)">★</span>
                        <span class="star" data-rating="4" onclick="setRating(4)">★</span>
                        <span class="star" data-rating="5" onclick="setRating(5)">★</span>
                    </div>
                    <input type="hidden" id="ratingValue" value="0" required>
                </div>

                <div class="review-form-group">
                    <label for="reviewName">Nama</label>
                    <input type="text" id="reviewName" class="review-form-control" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="review-form-group">
                    <label for="reviewText">Ulasan</label>
                    <textarea id="reviewText" class="review-form-control" placeholder="Tulis ulasan Anda..." required></textarea>
                </div>

                <button type="submit" class="btn-submit-review">Kirim Ulasan</button>
            </form>
        </div>
    </div>

    <!-- Review Success Modal -->
    <div class="success-modal" id="successModal">
        <div class="success-modal-content">
            <div class="success-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="8 12 11 15 16 9"></polyline>
                </svg>
            </div>
            <h3 class="success-title">Ulasan Berhasil Ditambahkan!</h3>
            <p class="success-message">
                Terima kasih atas ulasan Anda. Ulasan Anda sangat membantu kami untuk terus meningkatkan kualitas produk.
            </p>
            <button class="btn-close-success" onclick="closeSuccessModal()">Tutup</button>
        </div>
    </div>

    <!-- Not Found Modal -->
    <div class="not-found-modal" id="notFoundModal">
        <div class="not-found-content">
            <div class="not-found-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                    <line x1="8" y1="11" x2="14" y2="11"></line>
                </svg>
            </div>
            <h3 class="not-found-title">Produk Tidak Ditemukan</h3>
            <p class="not-found-message">
                Maaf, produk dengan kata kunci <span class="not-found-keyword" id="notFoundKeyword"></span> tidak ditemukan.
            </p>
            <button class="btn-close-not-found" onclick="closeNotFoundModal()">Tutup</button>
        </div>
    </div>

    <script>
        function addReview() {
            document.getElementById('reviewModal').classList.add('active');
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.remove('active');
            // Reset form
            document.getElementById('reviewName').value = '';
            document.getElementById('reviewText').value = '';
            document.getElementById('ratingValue').value = '0';
            document.querySelectorAll('.star').forEach(star => star.classList.remove('active'));
        }

        // Close modal when clicking outside
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReviewModal();
            }
        });

        let selectedRating = 0;

        function setRating(rating) {
            selectedRating = rating;
            document.getElementById('ratingValue').value = rating;
            
            // Update star display
            document.querySelectorAll('.star').forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function submitReview(event) {
            event.preventDefault();
            
            const rating = document.getElementById('ratingValue').value;
            const name = document.getElementById('reviewName').value;
            const review = document.getElementById('reviewText').value;

            if (rating === '0') {
                alert('Silakan pilih rating terlebih dahulu!');
                return;
            }

            // Save to database via AJAX
            fetch('{{ route("reviews.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: name,
                    rating: parseInt(rating),
                    review: review
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Create new review card
                    const reviewCard = document.createElement('div');
                    reviewCard.className = 'review-card';
                    reviewCard.style.animation = 'fadeIn 0.5s ease-out';
                    reviewCard.innerHTML = `
                        <div class="review-header">
                            <div class="review-avatar">
                                <svg viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="review-info">
                                <div class="review-stars">${'★'.repeat(rating)}</div>
                                <div class="review-name">${name}</div>
                            </div>
                        </div>
                        <p class="review-text">${review}</p>
                    `;

                    // Add animation style
                    const style = document.createElement('style');
                    style.textContent = `
                        @keyframes fadeIn {
                            from { opacity: 0; transform: translateY(-20px); }
                            to { opacity: 1; transform: translateY(0); }
                        }
                    `;
                    if (!document.querySelector('style[data-fadein]')) {
                        style.setAttribute('data-fadein', 'true');
                        document.head.appendChild(style);
                    }

                    // Add to reviews container
                    document.querySelector('.reviews-container').prepend(reviewCard);

                    // Close review modal
                    closeReviewModal();

                    // Show success modal
                    document.getElementById('successModal').classList.add('active');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menambahkan review');
            });
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.remove('active');
        }

        // Close success modal when clicking outside
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSuccessModal();
            }
        });

        // Hero Slider
        let currentSlide = 0;
        const slider = document.getElementById('heroSlider');
        const indicators = document.querySelectorAll('.indicator');
        const totalSlides = 5;

        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            goToSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            goToSlide(currentSlide);
        }

        function nextSlideManual() {
            clearInterval(autoSlide);
            nextSlide();
            autoSlide = setInterval(nextSlide, 4000);
        }

        // Auto slide every 4 seconds
        let autoSlide = setInterval(nextSlide, 4000);

        // Manual slide control
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                clearInterval(autoSlide);
                goToSlide(index);
                autoSlide = setInterval(nextSlide, 4000);
            });
        });

        // Hamburger Menu Toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            menuOverlay.classList.toggle('active');
        });

        // Close menu when clicking overlay
        menuOverlay.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
        });

        // Close menu when clicking a link
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                menuOverlay.classList.remove('active');
            });
        });

        function addToCart(button, productId, productName) {
            // Pastikan productId adalah integer
            const id = parseInt(productId);
            if (isNaN(id)) {
                console.error('Invalid product ID:', productId);
                showCartError('ID produk tidak valid');
                return;
            }

            button.disabled = true;
            const originalContent = button.innerHTML;
            button.innerHTML = '<span class="loading">Menambah...</span>';

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: id,
                    quantity: 1
                })
            })
            .then(async response => {
                const data = await response.json().catch(() => null);

                if (!response.ok || !data || data.success !== true) {
                    const message = data?.message || 'Gagal menambahkan ke keranjang';
                    showCartError(message);
                    if (response.status === 401) {
                        setTimeout(() => window.location.href = '/login', 1000);
                    }
                    return;
                }

                const badge = document.getElementById('cartBadge');
                if (badge && data.data?.total_items) {
                    badge.textContent = data.data.total_items;
                }
                showCartNotification(productName);
            })
            .catch(error => {
                showCartError('Terjadi kesalahan. Silakan coba lagi.');
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalContent;
            });
        }

        function showCartNotification(productName) {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 30px;
                background: #4caf50;
                color: white;
                padding: 15px 25px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                z-index: 10000;
                animation: slideIn 0.3s ease-out;
                font-weight: 600;
            `;
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <svg viewBox="0 0 24 24" style="width: 20px; height: 20px; stroke: white; fill: none; stroke-width: 2;">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>${productName} berhasil ditambahkan ke keranjang!</span>
                </div>
            `;

            // Add animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideIn {
                    from { transform: translateX(400px); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slideOut {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(400px); opacity: 0; }
                }
            `;
            document.head.appendChild(style);

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        function showCartError(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 30px;
                background: #d32f2f;
                color: white;
                padding: 15px 25px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                z-index: 10000;
                animation: slideIn 0.3s ease-out;
                font-weight: 600;
            `;
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <svg viewBox="0 0 24 24" style="width: 20px; height: 20px; stroke: white; fill: none; stroke-width: 2;">
                        <path d="M6 6l12 12M18 6L6 18"></path>
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Search functionality dihapus

        function closeNotFoundModal() {
            document.getElementById('notFoundModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('notFoundModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeNotFoundModal();
            }
        });

        // Update cart badge
        function updateCartBadge() {
            const badge = document.getElementById('cartBadge');
            if (badge) {
                fetch('/api/cart/count')
                    .then(response => response.json())
                    .then(data => {
                        if (data.count !== undefined) {
                            badge.textContent = data.count;
                        }
                    })
                    .catch(error => console.error('Error fetching cart count:', error));
            }
        }

        // Load cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();

            // Hamburger Menu Toggle
            const hamburger = document.getElementById('hamburger');
            const navMenu = document.getElementById('navMenu');
            const menuOverlay = document.getElementById('menuOverlay');

            if (hamburger && navMenu) {
                hamburger.addEventListener('click', function() {
                    navMenu.classList.toggle('active');
                    hamburger.classList.toggle('active');
                    menuOverlay.classList.toggle('active');
                });

                // Close menu when overlay is clicked
                menuOverlay.addEventListener('click', function() {
                    navMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                    menuOverlay.classList.remove('active');
                });

                // Close menu when a nav link is clicked
                navMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        navMenu.classList.remove('active');
                        hamburger.classList.remove('active');
                        menuOverlay.classList.remove('active');
                    });
                });
            }

            @auth
            loadNotifications();
            // Polling notifikasi tiap 30 detik
            setInterval(loadNotifications, 30000);
            @endauth

            // Force show product cards immediately
            console.log('Forcing product cards to be visible');
            document.querySelectorAll('.product-card').forEach((card, index) => {
                card.style.opacity = '1';
                card.style.visibility = 'visible';
                card.style.transform = 'translateY(0)';
                card.style.pointerEvents = 'auto';
                console.log('Product card ' + (index + 1) + ' forced visible');
            });

            // Verify sections are visible
            const bestSellers = document.querySelector('.best-sellers');
            if (bestSellers) {
                console.log('Best Sellers section found');
                bestSellers.style.visibility = 'visible';
                bestSellers.style.opacity = '1';
            } else {
                console.error('Best Sellers section NOT found');
            }

            // Verify header and nav are visible
            const header = document.querySelector('header');
            const nav = document.querySelector('nav');
            if (header) {
                console.log('Header found');
                header.style.visibility = 'visible';
                header.style.pointerEvents = 'auto';
            }
            if (nav) {
                console.log('Nav found');
                nav.style.visibility = 'visible';
                nav.style.pointerEvents = 'auto';
            }

            // Verify bottom nav
            const bottomNav = document.querySelector('.bottom-nav');
            if (bottomNav) {
                console.log('Bottom nav found');
                bottomNav.style.visibility = 'visible';
                bottomNav.style.pointerEvents = 'auto';
            }

            // Add to Cart for product cards with data attributes
            document.querySelectorAll('.btn-add-cart[data-product-id]').forEach(button => {
                if (!button.getAttribute('onclick')) {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-product-id');
                        const productName = this.getAttribute('data-product-name');
                        addToCart(this, productId, productName);
                    });
                }
            });

            // Tutup dropdown notifikasi saat klik di luar
            document.addEventListener('click', function(e) {
                const dropdown = document.getElementById('notifDropdown');
                if (dropdown && !dropdown.closest('.icon-wrapper')?.contains(e.target)) {
                    dropdown.classList.remove('active');
                }
            });
        });

        @auth
        function loadNotifications() {
            fetch('/api/notifications', { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(data => {
                    if (!data.success) return;

                    const badge  = document.getElementById('notifBadge');
                    const list   = document.getElementById('notifList');

                    // Update badge
                    if (data.unread_count > 0) {
                        badge.textContent = data.unread_count > 9 ? '9+' : data.unread_count;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }

                    // Render list
                    if (!data.notifications.length) {
                        list.innerHTML = '<div class="notif-empty">Tidak ada notifikasi</div>';
                        return;
                    }

                    const iconMap = { success: '✔', info: 'i', warning: '!' };
                    list.innerHTML = data.notifications.map(n => `
                        <div class="notif-item ${n.is_read ? '' : 'unread'}" onclick="readNotif(${n.id})">
                            <div class="notif-icon ${n.type}">${iconMap[n.type] || 'i'}</div>
                            <div class="notif-content">
                                <div class="notif-title">${n.title}</div>
                                <div class="notif-msg">${n.message}</div>
                                <div class="notif-time">${timeAgo(n.created_at)}</div>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(() => {});
        }

        function toggleNotifDropdown(e) {
            e.stopPropagation();
            const dropdown = document.getElementById('notifDropdown');
            dropdown.classList.toggle('active');
            if (dropdown.classList.contains('active')) {
                loadNotifications();
            }
        }

        function markAllRead() {
            fetch('/api/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            }).then(() => loadNotifications());
        }

        function readNotif(id) {
            fetch(`/api/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            }).then(() => loadNotifications());
        }

        function timeAgo(dateStr) {
            const diff = Math.floor((Date.now() - new Date(dateStr)) / 1000);
            if (diff < 60)   return 'Baru saja';
            if (diff < 3600) return Math.floor(diff/60) + ' menit lalu';
            if (diff < 86400)return Math.floor(diff/3600) + ' jam lalu';
            return Math.floor(diff/86400) + ' hari lalu';
        }
        @endauth
    </script>
    <script>
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
});

document.querySelectorAll('.fade-up').forEach(el => {
    observer.observe(el);
});

// ===== LOADING STATES =====

// 1. Page Loader
window.addEventListener('load', function() {
    const pageLoader = document.getElementById('pageLoader');
    if (pageLoader) {
        setTimeout(() => {
            pageLoader.classList.add('hidden');
        }, 300);
    }
    
    // Show actual products after skeleton
    const skeleton = document.getElementById('skeletonProducts');
    const actualProducts = document.getElementById('actualProducts');
    
    if (skeleton && actualProducts) {
        setTimeout(() => {
            skeleton.style.display = 'none';
            actualProducts.style.display = 'grid';
            actualProducts.style.animation = 'fadeIn 0.5s ease-in';
        }, 800);
    }
});

// 2. Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);

// 3. Enhanced Add to Cart with Loading State
window.addToCartWithLoading = function(btn, productId, itemName, price) {
    // Prevent double-click
    if (btn.classList.contains('btn-loading')) return;
    
    // Add loading state
    btn.classList.add('btn-loading');
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<span class="btn-text">Menambahkan...</span>';
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken || '',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: parseInt(productId),
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart badge with pulse animation
            const badge = document.getElementById('cartBadge');
            if (badge) {
                badge.textContent = data.data.total_items;
                badge.classList.add('pulse');
                setTimeout(() => badge.classList.remove('pulse'), 500);
            }
            
            // Show success checkmark
            btn.innerHTML = '<span class="success-checkmark"></span><span class="btn-text">Ditambahkan!</span>';
            btn.style.background = '#4caf50';
            
            // Reset button after 2 seconds
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.style.background = '';
                btn.classList.remove('btn-loading');
            }, 2000);
            
            showNotification(`${itemName} berhasil ditambahkan ke keranjang!`, 'success');
        } else {
            btn.classList.remove('btn-loading');
            btn.innerHTML = originalHTML;
            showNotification(data.message || 'Gagal menambahkan ke keranjang', 'error');
        }
    })
    .catch(error => {
        btn.classList.remove('btn-loading');
        btn.innerHTML = originalHTML;
        showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
    });
};

// 4. Update existing addToCart function
if (typeof window.addToCart === 'undefined') {
    window.addToCart = window.addToCartWithLoading;
}

</script>
</body>
</html>
