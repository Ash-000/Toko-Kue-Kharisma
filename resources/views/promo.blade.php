<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - Toko Kue Kharisma</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5deb3;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.3);
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

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.5);
            transform: translateX(-3px);
        }

        .btn-back svg {
            width: 20px;
            height: 20px;
            stroke: #2c2c2c;
            fill: none;
            stroke-width: 2.5;
        }

        .logo-section {
            display: flex;
            align-items: center;
        }

        .store-name {
            font-family: 'Brush Script MT', 'Lucida Handwriting', cursive;
            font-size: 28px;
            color: #2c2c2c;
            font-style: italic;
            font-weight: bold;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 10px;
            z-index: 1001;
        }

        .hamburger span {
            width: 30px;
            height: 3px;
            background: #4a4a4a;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }

        nav {
            display: flex;
            gap: 30px;
            align-items: center;
            transition: all 0.3s;
        }

        nav a {
            color: #4a4a4a;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: color 0.3s;
        }

        nav a:hover, nav a.active {
            color: #2c2c2c;
        }

        .header-icons {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .icon-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
        }

        .icon-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #2c2c2c;
            transition: transform 0.2s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-btn svg {
            width: 26px;
            height: 26px;
            stroke: #2c2c2c;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .icon-btn:hover {
            transform: scale(1.1);
        }

        .icon-label {
            font-size: 10px;
            color: #4a4a4a;
            font-weight: 600;
        }

        .icon-wrapper {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #d32f2f;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Hero Promo Banner */
        .promo-hero {
            position: relative;
            height: 350px;
            background-image: url('https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=1200&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding: 0 50px;
        }

        .promo-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #d32f2f;
            color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: rotate(-15deg);
        }

        .promo-badge-text {
            font-size: 18px;
            line-height: 1;
        }

        .promo-badge-percent {
            font-size: 24px;
            line-height: 1;
        }

        .promo-content {
            background: #f5f5f0;
            padding: 40px 50px;
            border-radius: 20px;
            max-width: 400px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .promo-title {
            font-size: 32px;
            font-weight: bold;
            color: #2c2c2c;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .promo-description {
            font-size: 16px;
            color: #4a4a4a;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .btn-order-now {
            background: white;
            border: 2px solid #2c2c2c;
            padding: 12px 35px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            color: #2c2c2c;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-order-now:hover {
            background: #2c2c2c;
            color: white;
        }

        /* Promo Packages Section */
        .promo-packages {
            padding: 50px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 28px;
            color: #8b7355;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .section-divider {
            width: 200px;
            height: 2px;
            background: #8b7355;
            margin: 0 auto 40px;
        }

        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .package-card {
            background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            position: relative;
        }

        .package-card:hover {
            transform: translateY(-5px);
        }

        .discount-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #d32f2f;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .package-image-container {
            background: white;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .package-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .package-name {
            font-size: 20px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 8px;
        }

        .package-description {
            font-size: 14px;
            color: #4a4a4a;
            margin-bottom: 12px;
        }

        .package-price {
            margin-bottom: 15px;
        }

        .original-price {
            font-size: 14px;
            color: #8b7355;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .discount-price {
            font-size: 20px;
            color: #2c2c2c;
            font-weight: bold;
        }

        .btn-buy-package {
            background: white;
            border: 2px solid #2c2c2c;
            border-radius: 25px;
            padding: 10px 30px;
            font-size: 14px;
            color: #2c2c2c;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-buy-package:hover {
            background: #2c2c2c;
            color: white;
        }

        /* Mobile Menu */
        .menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .menu-overlay.active {
            display: block;
        }

        @media (max-width: 968px) {
            .hamburger {
                display: flex;
            }

            nav {
                position: fixed;
                top: 0;
                right: -100%;
                width: 300px;
                height: 100vh;
                background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
                flex-direction: column;
                justify-content: flex-start;
                padding: 80px 30px 30px;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
                z-index: 1000;
            }

            nav.active {
                right: 0;
            }

            nav a {
                font-size: 18px;
                padding: 15px 0;
                width: 100%;
                border-bottom: 1px solid rgba(74, 74, 74, 0.2);
            }

            .promo-content {
                max-width: 100%;
            }

            .packages-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Menu Overlay -->
    <div class="menu-overlay" id="menuOverlay"></div>

    <!-- Header -->
    <header>
        <div class="header-left">
            <a href="/" class="btn-back">
                <svg viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
            <div class="logo-section">
                <span class="store-name">Toko kue kharisma</span>
            </div>
        </div>
        
        <nav id="navMenu">
            <a href="/">home</a>
            <a href="/menu">menu</a>
            <a href="/kontak">kontak</a>
            <a href="/promo" class="active">promo</a>
        </nav>

        <div class="header-icons">
            <div class="icon-wrapper">
                <button class="icon-btn" title="Pesan">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </button>
                <span class="icon-label">Pesan</span>
            </div>
            <div class="icon-wrapper">
                <button type="button" class="icon-btn" title="Keranjang" onclick="window.location.href='/cart'">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="cart-badge" id="cartBadge">0</span>
                </button>
                <span class="icon-label">Keranjang</span>
            </div>
            <div class="icon-wrapper">
                <button class="icon-btn" title="Profil" onclick="window.location.href='/login'">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="10" r="3"></circle>
                        <path d="M6.168 18.849A4 4 0 0 1 10 16h4a4 4 0 0 1 3.834 2.855"></path>
                    </svg>
                </button>
                <span class="icon-label">Profil</span>
            </div>
            
            <!-- Hamburger Menu -->
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <!-- Hero Promo Banner -->
    <section class="promo-hero">
        <div class="promo-badge">
            <span class="promo-badge-text">DISKON</span>
            <span class="promo-badge-percent">20%</span>
            <span class="promo-badge-text">OFF</span>
        </div>

        <div class="promo-content">
            <h1 class="promo-title">PROMO<br>PAKET KUE<br>SPESIAL</h1>
            <p class="promo-description">diskon 20% untuk pembelian PAKET!</p>
            <button class="btn-order-now" onclick="scrollToPackages()">PESAN SEKARANG</button>
        </div>
    </section>

    <!-- Promo Packages Section -->
    <section class="promo-packages" id="packages">
        <h2 class="section-title">Paket promo spesial</h2>
        <div class="section-divider"></div>

        <div class="packages-grid">
            <!-- Package 1 -->
            <div class="package-card">
                <div class="discount-badge">Diskon 20%</div>
                <div class="package-image-container">
                    <img src="/images/products/dadar-gulung.jpg" alt="Paketan Hemat A" class="package-image">
                </div>
                <h3 class="package-name">Paketan Hemat A</h3>
                <p class="package-description">Dadar Gulung, Lemper, Putu Ayu, Lupis, Kue Apem</p>
                <div class="package-price">
                    <span class="original-price">Rp 25.000</span>
                    <span class="discount-price">Rp 20.000</span>
                </div>
                <button class="btn-buy-package" onclick="window.location.href='/menu'">PESAN SEKARANG</button>
            </div>

            <!-- Package 2 -->
            <div class="package-card">
                <div class="discount-badge">Diskon 20%</div>
                <div class="package-image-container">
                    <img src="/images/products/kue-talam-suji.jpg" alt="Paketan Hemat B" class="package-image">
                </div>
                <h3 class="package-name">Paketan Hemat B</h3>
                <p class="package-description">Talam Suji, Pepe Hijau, Pepe Pelangi, Ongol-Ongol, Kue Lumpur</p>
                <div class="package-price">
                    <span class="original-price">Rp 25.000</span>
                    <span class="discount-price">Rp 20.000</span>
                </div>
                <button class="btn-buy-package" onclick="window.location.href='/menu'">PESAN SEKARANG</button>
            </div>

            <!-- Package 3 -->
            <div class="package-card">
                <div class="discount-badge">Diskon 20%</div>
                <div class="package-image-container">
                    <img src="/images/products/bolu-pelangi.jpg" alt="Paketan Hemat C" class="package-image">
                </div>
                <h3 class="package-name">Paketan Hemat C</h3>
                <p class="package-description">Bolu Pelangi, Pie Buah, Pie Brownies, Risoles, Pastel</p>
                <div class="package-price">
                    <span class="original-price">Rp 25.000</span>
                    <span class="discount-price">Rp 20.000</span>
                </div>
                <button class="btn-buy-package" onclick="window.location.href='/menu'">PESAN SEKARANG</button>
            </div>
        </div>
    </section>

    <script>
        // Hamburger Menu Toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            menuOverlay.classList.toggle('active');
        });

        menuOverlay.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
        });

        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                menuOverlay.classList.remove('active');
            });
        });

        function scrollToPackages() {
            document.getElementById('packages').scrollIntoView({ behavior: 'smooth' });
        }

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
        });
    </script>
</body>
</html>
