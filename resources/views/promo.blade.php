<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Promo - Toko Kue Kharisma</title>
    @include('partials.skeleton-loader')
    <style>
        /* --- CSS TETAP SAMA SEPERTI SEBELUMNYA --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { overflow-x: hidden; max-width: 100%; }
        body { font-family: Arial, Helvetica, sans-serif; background: #f5deb3; }
        header { 
            background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%); 
            padding: 15px clamp(15px, 4vw, 50px); 
            display: flex; justify-content: space-between; align-items: center; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); position: sticky; top: 0; z-index: 1000;
        }
        .header-left { display: flex; align-items: center; gap: 20px; }
        .btn-back { 
            display: flex; align-items: center; gap: 10px; background: rgba(255, 255, 255, 0.3); 
            border: none; padding: 8px 15px; border-radius: 10px; color: #2c2c2c; 
            font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; text-decoration: none; 
        }
        .btn-back:hover { background: rgba(255, 255, 255, 0.5); transform: translateX(-3px); }
        .btn-back svg { width: 20px; height: 20px; stroke: #2c2c2c; fill: none; stroke-width: 2.5; }
        .store-name { font-family: 'Brush Script MT', cursive; font-size: 28px; color: #2c2c2c; font-weight: bold; }
        nav { display: flex; gap: 30px; align-items: center; }
       /* Gaya dasar link nav */
        nav a {
            color: #4a4a4a;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            text-transform: capitalize; /* Biar huruf depan otomatis gede */
            position: relative; /* Penting untuk efek underline */
            padding: 5px 0;
            transition: color 0.3s ease;
        }

        /* Efek Underline yang mengalir dari tengah */
        nav a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #8b7355;
            transition: all 0.3s ease-in-out;
            transform: translateX(-50%);
        }

        /* Warna & Underline saat Hover */
        nav a:hover {
            color: #2c2c2c;
        }

        nav a:hover::after {
            width: 100%;
        }

        /* Gaya untuk link yang sedang aktif (Kontak) */
        nav a.active {
            color: #8b7355;
        }

        nav a.active::after {
            width: 80%; /* Garis bawah tetap ada di menu aktif */
            background-color: #8b7355;
        }

        /* Tambahan: Sedikit animasi floating biar lebih 'hidup' */
        @keyframes navFloat {
            0% { transform: translateY(0); }
            50% { transform: translateY(-2px); }
            100% { transform: translateY(0); }
        }

        nav a:hover {
            animation: navFloat 1s ease-in-out infinite;
        }
        
        .header-icons { display: flex; gap: 20px; align-items: center; }
        .icon-wrapper { display: flex; flex-direction: column; align-items: center; position: relative; }
        .icon-btn { background: none; border: none; cursor: pointer; transition: transform 0.2s; }
        .icon-btn svg { width: 22px; height: 22px; stroke: #2c2c2c; fill: none; stroke-width: 2; }
        .cart-badge { 
            position: absolute; top: -5px; right: -5px; background: #d32f2f; color: white; 
            border-radius: 50%; width: 18px; height: 18px; font-size: 11px; 
            display: flex; align-items: center; justify-content: center; font-weight: bold;
        }
        .icon-label { font-size: 9px; font-weight: 600; color: #4a4a4a; }
        .promo-packages { padding: 50px; max-width: 1400px; margin: 0 auto; }
        .section-title { 
            text-align: center; font-size: 28px; color: #8b7355; margin-bottom: 10px; 
            font-weight: 700;
            animation: fadeInDown 0.6s ease-out;
        }
        .section-divider { 
            width: 150px; height: 3px; background: linear-gradient(90deg, transparent, #d32f2f, transparent); 
            margin: 0 auto 40px;
            animation: scaleIn 0.6s ease-out 0.2s backwards;
        }
        
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes scaleIn {
            from { transform: scaleX(0); }
            to { transform: scaleX(1); }
        }
        .packages-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        .package-card { 
            background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%); 
            border-radius: 20px; padding: 25px; text-align: center; position: relative;
            transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            animation: slideUp 0.5s ease-out;
        }
        .package-card:hover { 
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .discount-badge { 
            position: absolute; top: 15px; right: 15px; background: #d32f2f; color: white; 
            padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 12px; 
        }
        .package-image-container { background: white; border-radius: 15px; padding: 10px; margin-bottom: 15px; height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center; }
        .package-image { max-width: 100%; height: auto; border-radius: 10px; }
        .package-name { font-size: 20px; margin-bottom: 10px; color: #2c2c2c; }
        .package-description { font-size: 14px; color: #4a4a4a; margin-bottom: 15px; min-height: 40px; }
        .original-price { text-decoration: line-through; color: #8b7355; margin-right: 10px; font-size: 14px; }
        .discount-price { font-size: 20px; font-weight: bold; color: #2c2c2c; }
        .btn-buy-package { 
            background: white; border: 2px solid #2c2c2c; border-radius: 25px; 
            padding: 10px 20px; cursor: pointer; font-weight: 600; 
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-buy-package::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: #2c2c2c;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
            z-index: 0;
        }
        .btn-buy-package:hover::before {
            width: 300px;
            height: 300px;
        }
        .btn-buy-package:hover {
            color: white;
        }
        .btn-buy-package span {
            position: relative;
            z-index: 1;
        }

        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 10px; z-index: 1001; }
        .hamburger span { width: 30px; height: 3px; background: #4a4a4a; border-radius: 3px; transition: all 0.3s; }
        .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(8px, 8px); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(8px, -8px); }
        .menu-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }
        .menu-overlay.active { display: block; }

        @media (max-width: 768px) {
            .hamburger { display: flex; }
            nav {
                position: fixed; top: 70px; right: -100%;
                width: 300px; height: calc(100vh - 70px);
                background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
                flex-direction: column; justify-content: flex-start;
                padding: 30px;
                box-shadow: -5px 0 15px rgba(0,0,0,0.2); z-index: 1001;
                transition: right 0.3s ease; overflow-y: auto;
                display: flex;
            }
            nav.active { right: 0; }
            nav a { font-size: 18px; padding: 15px 0; width: 100%; border-bottom: 1px solid rgba(74,74,74,0.2); }

            header {
                padding: 15px 20px;
            }

            .store-name {
                font-size: 20px;
            }

            .promo-packages {
                padding: 40px 20px;
            }

            .packages-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }
        }

        /* Tablet breakpoint */
        @media (max-width: 1024px) {
            .packages-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .promo-packages {
                padding: 40px 30px;
            }
        }

        /* Small mobile */
        @media (max-width: 480px) {
            .promo-packages {
                padding: 30px 15px;
            }

            .section-title {
                font-size: 24px;
            }

            .package-card {
                padding: 20px;
            }

            .package-name {
                font-size: 18px;
            }

            .package-description {
                font-size: 13px;
            }

            .btn-buy-package {
                font-size: 13px;
                padding: 8px 16px;
            }
        }

        /* Extra small mobile */
        @media (max-width: 375px) {
            .store-name {
                font-size: 18px;
            }

            nav {
                width: 250px;
            }

            .section-title {
                font-size: 22px;
            }
        }
    </style>
    @include('partials.notif-styles')
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
        
 <nav id="navMenu">
    <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">home</a>
    <a href="/menu" class="{{ Request::is('menu') ? 'active' : '' }}">menu</a>
    <a href="/riwayat" class="{{ Request::is('riwayat') ? 'active' : '' }}">riwayat</a>
    <a href="/kontak" class="{{ Request::is('kontak') ? 'active' : '' }}">kontak</a>
    <a href="/promo" class="{{ Request::is('promo') ? 'active' : '' }}">promo</a>
</nav>

        <div class="header-icons">
            @include('partials.header-icons')
            <div class="icon-wrapper">
                <button class="icon-btn" onclick="window.location.href='/cart'">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="cart-badge" id="cartBadge">0</span>
                </button>
                <span class="icon-label">Keranjang</span>
            </div>
            <div class="icon-wrapper">
                <button class="icon-btn" onclick="window.location.href='/login'">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="10" r="3"></circle>
                        <path d="M6.168 18.849A4 4 0 0 1 10 16h4a4 4 0 0 1 3.834 2.855"></path>
                    </svg>
                </button>
                <span class="icon-label">Profil</span>
            </div>
            <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
        </div>
    </header>
    <div class="menu-overlay" id="menuOverlay"></div>

    <section class="promo-packages">
        <h2 class="section-title">Paket Promo Spesial</h2>
        <div class="section-divider"></div>

        <div class="packages-grid">
            <div class="package-card">
                <div class="discount-badge">Diskon 20%</div>
                <div class="package-image-container">
                    <img src="/images/products/pasar.jpg" alt="Paket A" class="package-image" loading="lazy">
                </div>
                <h3 class="package-name">Paketan Hemat A</h3>
                <p class="package-description">Dadar Gulung, Lemper, Putu Ayu, Lupis, Kue Apem</p>
                <div class="package-price">
                    <span class="original-price">Rp 25.000</span>
                    <span class="discount-price">Rp 20.000</span>
                </div>
               <button class="btn-buy-package" onclick="addToCart(this, 901, 20000, 'Paketan Hemat A')">
    <span>MASUKKAN KE KERANJANG</span>
</button>
            </div>

            <div class="package-card">
                <div class="discount-badge">Diskon 20%</div>
                <div class="package-image-container">
                    <img src="/images/products/keren.jpg" alt="Paket B" class="package-image" loading="lazy">
                </div>
                <h3 class="package-name">Paketan Hemat B</h3>
                <p class="package-description">Talam Suji, Pepe Hijau, Pepe Pelangi, Ongol-Ongol, Kue Lumpur</p>
                <div class="package-price">
                    <span class="original-price">Rp 25.000</span>
                    <span class="discount-price">Rp 20.000</span>
                </div>
                <button class="btn-buy-package" onclick="addToCart(this, 902, 20000, 'Paketan Hemat B')">
    <span>MASUKKAN KE KERANJANG</span>
</button>
            </div>

            <div class="package-card">
                <div class="discount-badge">Diskon 20%</div>
                <div class="package-image-container">
                    <img src="/images/products/gacor.jpg" alt="Paket C" class="package-image" loading="lazy">
                </div>
                <h3 class="package-name">Paketan Hemat C</h3>
                <p class="package-description">Bolu Pelangi, Pie Buah, Pie Brownies, Risoles, Pastel</p>
                <div class="package-price">
                    <span class="original-price">Rp 25.000</span>
                    <span class="discount-price">Rp 20.000</span>
                </div>
                <button class="btn-buy-package" onclick="addToCart(this, 903, 20000, 'Paketan Hemat C')">
    <span>MASUKKAN KE KERANJANG</span>
</button>
            </div>
        </div>
    </section>

    <script>
        // 1. Fungsi Tambah ke Keranjang dengan Loading State
        function addToCart(btn, productId, promoPrice, packageName) {
            // Prevent double-click
            if (btn.classList.contains('btn-loading')) return;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            if (!csrfToken) {
                console.error('CSRF token not found');
                showNotification('Gagal: Token keamanan tidak ditemukan', 'error');
                return;
            }

            // Add loading state
            btn.classList.add('btn-loading');
            const originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="btn-text">Menambahkan...</span>';

            fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1,
                    price: promoPrice,
                    name: packageName 
                })
            })
            .then(response => {
                if (response.status === 401) {
                    showNotification('Silakan login terlebih dahulu', 'error');
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}";
                    }, 1500);
                    return null;
                }
                
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`HTTP ${response.status}: ${text}`);
                    });
                }
                
                return response.json();
            })
            .then(data => {
                if (data) {
                    if (data.success) {
                        // Update cart badge with pulse
                        const badge = document.getElementById('cartBadge');
                        if (badge) {
                            updateCartBadge();
                            badge.classList.add('pulse');
                            setTimeout(() => badge.classList.remove('pulse'), 500);
                        }
                        
                        // Show success state
                        btn.innerHTML = '<span class="success-checkmark"></span><span class="btn-text">Ditambahkan!</span>';
                        btn.style.background = '#4caf50';
                        
                        // Reset after 2 seconds
                        setTimeout(() => {
                            btn.innerHTML = originalHTML;
                            btn.style.background = '';
                            btn.classList.remove('btn-loading');
                            btn.disabled = false;
                        }, 2000);
                        
                        showNotification(data.message || 'Berhasil ditambah ke keranjang', 'success');
                    } else {
                        btn.classList.remove('btn-loading');
                        btn.innerHTML = originalHTML;
                        btn.disabled = false;
                        showNotification(data.message || 'Gagal menambahkan ke keranjang', 'error');
                    }
                }
            })
            .catch(error => {
                btn.classList.remove('btn-loading');
                btn.innerHTML = originalHTML;
                btn.disabled = false;
                showNotification('Terjadi kesalahan: ' + error.message, 'error');
            });
        }

        // 2. Update Badge Keranjang
        function updateCartBadge() {
            const badge = document.getElementById('cartBadge');
            if (!badge) return;
            
            fetch('/api/cart/count')
                .then(response => {
                    if (!response.ok) throw new Error('Failed to fetch cart count');
                    return response.json();
                })
                .then(data => {
                    if (data && data.count !== undefined) {
                        badge.textContent = data.count;
                    }
                })
                .catch(err => {});
        }

        // 3. Sistem Notifikasi Pop-up
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? '#4caf50' : '#f44336';
            const borderColor = type === 'success' ? '#45a049' : '#e53935';
            
            notification.style.cssText = `
                position: fixed; top: 20px; right: 20px; 
                background: ${bgColor}; color: white; 
                padding: 16px 24px; border-radius: 8px; 
                z-index: 9999; box-shadow: 0 6px 20px rgba(0,0,0,0.3);
                font-weight: 500; font-size: 14px;
                animation: slideIn 0.3s ease-in-out;
                border-left: 4px solid ${borderColor};
                max-width: 400px;
                word-wrap: break-word;
            `;
            notification.textContent = message;

            // Tambahkan animation CSS
            if (!document.querySelector('style[data-notification]')) {
                const style = document.createElement('style');
                style.setAttribute('data-notification', 'true');
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
            }

            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-in-out';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // Load awal
        document.addEventListener('DOMContentLoaded', function() {
            // Hide page loader
            const pageLoader = document.getElementById('pageLoader');
            if (pageLoader) {
                setTimeout(() => {
                    pageLoader.classList.add('hidden');
                }, 300);
            }
            
            updateCartBadge();

            // Hamburger menu
            const hamburger = document.getElementById('hamburger');
            const navMenu   = document.getElementById('navMenu');
            const overlay   = document.getElementById('menuOverlay');

            if (hamburger && navMenu && overlay) {
                hamburger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    hamburger.classList.toggle('active');
                    navMenu.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
                overlay.addEventListener('click', function() {
                    hamburger.classList.remove('active');
                    navMenu.classList.remove('active');
                    overlay.classList.remove('active');
                });
                navMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        hamburger.classList.remove('active');
                        navMenu.classList.remove('active');
                        overlay.classList.remove('active');
                    });
                });
            }
        });
    </script>
    @include('partials.notif-scripts')
</body>
</html>
