<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Toko Kue Kharisma</title>
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

        nav a:hover {
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

        /* Profile Section */
        .profile-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 50px;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
        }

        /* Sidebar */
        .profile-sidebar {
            background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #2c2c2c;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-avatar svg {
            width: 70px;
            height: 70px;
            stroke: white;
            fill: none;
            stroke-width: 2;
        }

        .profile-name {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 5px;
        }

        .profile-email {
            text-align: center;
            font-size: 14px;
            color: #6b6b6b;
            margin-bottom: 25px;
        }

        .profile-menu {
            list-style: none;
        }

        .profile-menu li {
            margin-bottom: 10px;
        }

        .profile-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            text-decoration: none;
            color: #2c2c2c;
            font-weight: 600;
            transition: all 0.3s;
        }

        .profile-menu a:hover, .profile-menu a.active {
            background: white;
            transform: translateX(5px);
        }

        .profile-menu svg {
            width: 20px;
            height: 20px;
            stroke: #2c2c2c;
            fill: none;
            stroke-width: 2;
        }

        .btn-logout {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #d32f2f;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-logout:hover {
            background: #b71c1c;
        }

        /* Main Content */
        .profile-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f5deb3;
        }

        /* Profile Info Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #4a4a4a;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            color: #2c2c2c;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #8b7355;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-save {
            background: #8b7355;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-save:hover {
            background: #6b5845;
        }

        /* Order History */
        .order-card {
            background: #f5f5f0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #8b7355;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .order-id {
            font-size: 16px;
            font-weight: 600;
            color: #2c2c2c;
        }

        .order-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-completed {
            background: #4caf50;
            color: white;
        }

        .status-processing {
            background: #ff9800;
            color: white;
        }

        .status-pending {
            background: #9e9e9e;
            color: white;
        }

        .order-items {
            font-size: 14px;
            color: #6b6b6b;
            margin-bottom: 10px;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
        }

        .order-date {
            font-size: 13px;
            color: #8b7355;
        }

        .order-total {
            font-size: 16px;
            font-weight: 600;
            color: #2c2c2c;
        }

        /* Address Section */
        .address-card {
            background: #f5f5f0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            position: relative;
        }

        .address-label {
            display: inline-block;
            background: #8b7355;
            color: white;
            padding: 4px 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .address-name {
            font-size: 16px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 5px;
        }

        .address-phone {
            font-size: 14px;
            color: #6b6b6b;
            margin-bottom: 10px;
        }

        .address-detail {
            font-size: 14px;
            color: #4a4a4a;
            line-height: 1.6;
        }

        .btn-add-address {
            width: 100%;
            padding: 15px;
            background: white;
            border: 2px dashed #8b7355;
            border-radius: 15px;
            color: #8b7355;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-add-address:hover {
            background: #f5f5f0;
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

            .profile-container {
                grid-template-columns: 1fr;
                padding: 0 20px;
            }

            .form-row {
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
            <a href="/promo">promo</a>
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
                <button class="icon-btn" title="Profil" onclick="window.location.href='/profile'">
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

    <!-- Profile Container -->
    <div class="profile-container">
        <!-- Sidebar -->
        <aside class="profile-sidebar">
            <div class="profile-avatar">
                <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <h2 class="profile-name">{{ $user->name ?? 'User' }}</h2>
            <p class="profile-email">{{ $user->email ?? 'user@email.com' }}</p>

            <ul class="profile-menu">
                <li>
                    <a href="#" class="active" onclick="showSection('info')">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Informasi Profil
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('orders')">
                        <svg viewBox="0 0 24 24">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>
                        Riwayat Pesanan
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('address')">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Alamat Pengiriman
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('settings')">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M12 1v6m0 6v6m-9-9h6m6 0h6"></path>
                        </svg>
                        Pengaturan
                    </a>
                </li>
            </ul>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Keluar</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="profile-content">
            <!-- Profile Info Section -->
            <section id="info" class="content-section active">
                <h2 class="section-title">Informasi Profil</h2>
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">Nama Lengkap</label>
                            <input type="text" id="firstName" class="form-control" value="{{ $user->name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Username</label>
                            <input type="text" id="lastName" class="form-control" value="{{ $user->email ?? '' }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" value="{{ $user->email ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" class="form-control" value="081234567890">
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Tanggal Lahir</label>
                        <input type="date" id="birthdate" class="form-control" value="1990-01-01">
                    </div>

                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </form>
            </section>

            <!-- Order History Section -->
            <section id="orders" class="content-section">
                <h2 class="section-title">Riwayat Pesanan</h2>

                <div class="order-card">
                    <div class="order-header">
                        <span class="order-id">#ORDER-001</span>
                        <span class="order-status status-completed">Selesai</span>
                    </div>
                    <div class="order-items">
                        3x Kue Pepe, 2x Kue Putri Ayu, 1x Kue Lopis
                    </div>
                    <div class="order-footer">
                        <span class="order-date">15 Januari 2026</span>
                        <span class="order-total">Rp 20.000</span>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-header">
                        <span class="order-id">#ORDER-002</span>
                        <span class="order-status status-processing">Diproses</span>
                    </div>
                    <div class="order-items">
                        1x Paketan Hemat A
                    </div>
                    <div class="order-footer">
                        <span class="order-date">8 Februari 2026</span>
                        <span class="order-total">Rp 20.000</span>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-header">
                        <span class="order-id">#ORDER-003</span>
                        <span class="order-status status-pending">Menunggu</span>
                    </div>
                    <div class="order-items">
                        5x Kue Dadar Gulung
                    </div>
                    <div class="order-footer">
                        <span class="order-date">8 Februari 2026</span>
                        <span class="order-total">Rp 12.500</span>
                    </div>
                </div>
            </section>

            <!-- Address Section -->
            <section id="address" class="content-section">
                <h2 class="section-title">Alamat Pengiriman</h2>

                <div class="address-card">
                    <span class="address-label">Alamat Utama</span>
                    <div class="address-name">{{ $user->name ?? 'User' }}</div>
                    <div class="address-phone">081234567890</div>
                    <div class="address-detail">
                        Jl. Merdeka No. 123, RT 01/RW 02<br>
                        Kelurahan Sukamaju, Kecamatan Bandung Tengah<br>
                        Kota Bandung, Jawa Barat 40123
                    </div>
                </div>

                <div class="address-card">
                    <span class="address-label">Alamat Kantor</span>
                    <div class="address-name">{{ $user->name ?? 'User' }}</div>
                    <div class="address-phone">081234567890</div>
                    <div class="address-detail">
                        Gedung Plaza Indonesia, Lantai 5<br>
                        Jl. Thamrin No. 28-30<br>
                        Jakarta Pusat, DKI Jakarta 10350
                    </div>
                </div>

                <button class="btn-add-address" onclick="alert('Fitur tambah alamat akan segera tersedia!')">
                    + Tambah Alamat Baru
                </button>
            </section>

            <!-- Settings Section -->
            <section id="settings" class="content-section">
                <h2 class="section-title">Pengaturan</h2>

                <div class="form-group">
                    <label for="currentPassword">Password Saat Ini</label>
                    <input type="password" id="currentPassword" class="form-control" placeholder="Masukkan password saat ini">
                </div>

                <div class="form-group">
                    <label for="newPassword">Password Baru</label>
                    <input type="password" id="newPassword" class="form-control" placeholder="Masukkan password baru">
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Konfirmasi Password Baru</label>
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Konfirmasi password baru">
                </div>

                <button type="submit" class="btn-save">Ubah Password</button>
            </section>
        </main>
    </div>

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

        // Show Section
        function showSection(sectionId) {
            event.preventDefault();
            
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });

            // Remove active from all menu items
            document.querySelectorAll('.profile-menu a').forEach(link => {
                link.classList.remove('active');
            });

            // Show selected section
            document.getElementById(sectionId).classList.add('active');

            // Add active to clicked menu item
            event.target.closest('a').classList.add('active');
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
