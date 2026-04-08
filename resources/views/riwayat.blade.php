<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan - Toko Kue Kharisma</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #f5deb3 0%, #f4d4a8 100%);
            min-height: 100vh;
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

        /* Main Content */
        .riwayat-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 50px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 30px;
        }

        /* Order Card */
        .order-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f5f5f0;
        }

        .order-id {
            font-size: 18px;
            font-weight: 600;
            color: #2c2c2c;
        }

        .order-date {
            font-size: 14px;
            color: #8b7355;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 60px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e0e0e0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-icon {
            position: absolute;
            left: -40px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .timeline-icon.completed {
            background: #4caf50;
        }

        .timeline-icon.active {
            background: #2196f3;
        }

        .timeline-icon svg {
            width: 22px;
            height: 22px;
            stroke: white;
            fill: none;
            stroke-width: 2.5;
        }

        .timeline-content {
            background: #f5f5f0;
            padding: 15px 20px;
            border-radius: 10px;
        }

        .timeline-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 5px;
        }

        .timeline-description {
            font-size: 14px;
            color: #6b6b6b;
            line-height: 1.5;
        }

        .order-items {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .order-items-title {
            font-size: 14px;
            font-weight: 600;
            color: #4a4a4a;
            margin-bottom: 10px;
        }

        .order-items-list {
            font-size: 14px;
            color: #6b6b6b;
            line-height: 1.6;
        }

        .order-total {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 16px;
            font-weight: 600;
            color: #2c2c2c;
        }

        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #8b7355;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 20px;
        }

        .empty-state svg {
            width: 100px;
            height: 100px;
            stroke: #d4b896;
            fill: none;
            stroke-width: 1.5;
            margin-bottom: 20px;
        }

        .empty-state-text {
            font-size: 18px;
            color: #8b7355;
            margin-bottom: 20px;
        }

        .btn-shop {
            background: #8b7355;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-shop:hover {
            background: #6b5845;
        }

        @media (max-width: 768px) {
            .riwayat-container {
                padding: 0 20px;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .timeline {
                padding-left: 50px;
            }

            .timeline-icon {
                left: -35px;
                width: 35px;
                height: 35px;
            }
        }
    </style>
</head>
<body>
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
                <button class="icon-btn" title="Keranjang" onclick="window.location.href='/cart'">
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
        </div>
    </header>

    <!-- Main Content -->
    <div class="riwayat-container">
        <h1 class="page-title">Riwayat Pemesanan</h1>
        <div id="orderHistoryContainer">
        @forelse($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <div>
                    <div class="order-id">#{{ $order->order_number }}</div>
                    <div class="order-date">{{ $order->created_at->format('d F Y, H:i') }}</div>
                </div>
            </div>

            <div class="timeline">
                <!-- Step 1: Verified -->
                <div class="timeline-item">
                    <div class="timeline-icon {{ in_array($order->status, ['verified', 'in_progress', 'completed']) ? 'completed' : ($order->status == 'pending' ? 'active' : '') }}">
                        <svg viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-title">
                            @if($order->status == 'pending')
                                Menunggu Verifikasi
                            @else
                                Pesanan telah diverifikasi
                            @endif
                        </div>
                        <div class="timeline-description">
                            @if($order->status == 'pending')
                                Bukti pembayaran sedang dicek admin
                            @else
                                Pesanan telah dikonfirmasi admin
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Step 2: In Progress -->
                <div class="timeline-item">
                    <div class="timeline-icon {{ in_array($order->status, ['in_progress', 'completed']) ? 'completed' : ($order->status == 'verified' ? 'active' : '') }}">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-title">
                            @if($order->status == 'in_progress')
                                Pesanan sedang dibuat
                            @else
                                Pesanan sedang dibuat oleh penjual
                            @endif
                        </div>
                        <div class="timeline-description">Pesanan Anda sedang dalam proses pembuatan</div>
                    </div>
                </div>

                <!-- Step 3: Completed -->
                <div class="timeline-item">
                    <div class="timeline-icon {{ $order->status == 'completed' ? 'completed' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-title">
                            @if($order->status == 'completed')
                                Pesanan telah diterima
                            @else
                                Pesanan selesai, menuju lokasi
                            @endif
                        </div>
                        <div class="timeline-description">
                            @if($order->status == 'completed')
                                Terima kasih telah berbelanja di toko kami!
                            @else
                                Pesanan akan segera dikirim ke alamat Anda
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-items">
                <div class="order-items-title">Detail Pesanan:</div>
                <div class="order-items-list">
                    @foreach($order->orderItems as $item)
                        {{ $item->quantity }}x {{ $item->product->name }}<br>
                    @endforeach
                </div>
            </div>

            <div class="order-total">
                <span class="total-label">Total Pembayaran:</span>
                <span class="total-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 20px;">
            <svg viewBox="0 0 24 24" style="width: 80px; height: 80px; stroke: #d4b896; fill: none; stroke-width: 1.5; margin-bottom: 20px;">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <h3 style="font-size: 20px; color: #2c2c2c; margin-bottom: 10px;">Belum Ada Pesanan</h3>
            <p style="font-size: 15px; color: #6b6b6b; margin-bottom: 20px;">Anda belum memiliki riwayat pesanan</p>
            <button onclick="window.location.href='/menu'" style="
                background: #8b7355;
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 25px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
            ">Mulai Belanja</button>
        </div>
        @endforelse
        </div>
    </div>

    <script>
        // Hamburger Menu
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        if (hamburger && navMenu && menuOverlay) {
            hamburger.addEventListener('click', function(e) {
                e.stopPropagation();
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

        // Render order history from JSON response
        function renderOrderHistory(orders) {
            const container = document.getElementById('orderHistoryContainer');
            if (!container) {
                return;
            }

            if (!orders || orders.length === 0) {
                container.innerHTML = `
                    <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 20px;">
                        <svg viewBox="0 0 24 24" style="width: 80px; height: 80px; stroke: #d4b896; fill: none; stroke-width: 1.5; margin-bottom: 20px;">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <h3 style="font-size: 20px; color: #2c2c2c; margin-bottom: 10px;">Belum Ada Pesanan</h3>
                        <p style="font-size: 15px; color: #6b6b6b; margin-bottom: 20px;">Anda belum memiliki riwayat pesanan</p>
                        <button onclick="window.location.href='/menu'" style="
                            background: #8b7355;
                            color: white;
                            border: none;
                            padding: 12px 30px;
                            border-radius: 25px;
                            font-size: 15px;
                            font-weight: 600;
                            cursor: pointer;
                        ">Mulai Belanja</button>
                    </div>
                `;
                return;
            }

            const markup = orders.map(order => {
                const step1Status = ['verified', 'in_progress', 'completed'].includes(order.status) ? 'completed' : (order.status === 'pending' ? 'active' : '');
                const step2Status = ['in_progress', 'completed'].includes(order.status) ? 'completed' : (order.status === 'verified' ? 'active' : '');
                const step3Status = order.status === 'completed' ? 'completed' : '';

                const step1Title = order.status === 'pending' ? 'Menunggu Verifikasi' : 'Pesanan telah diverifikasi';
                const step1Desc = order.status === 'pending' ? 'Bukti pembayaran sedang dicek admin' : 'Pesanan telah dikonfirmasi admin';
                const step2Title = order.status === 'in_progress' ? 'Pesanan sedang dibuat' : 'Pesanan sedang dibuat oleh penjual';
                const step3Title = order.status === 'completed' ? 'Pesanan telah diterima' : 'Pesanan selesai, menuju lokasi';
                const step3Desc = order.status === 'completed' ? 'Terima kasih telah berbelanja di toko kami!' : 'Pesanan akan segera dikirim ke alamat Anda';

                const itemsHtml = order.order_items.map(item => `${item.quantity}x ${item.name}`).join('<br>');

                return `
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <div class="order-id">#${order.order_number}</div>
                                <div class="order-date">${order.created_at}</div>
                            </div>
                        </div>

                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-icon ${step1Status}">
                                    <svg viewBox="0 0 24 24">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">${step1Title}</div>
                                    <div class="timeline-description">${step1Desc}</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon ${step2Status}">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                    </svg>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">${step2Title}</div>
                                    <div class="timeline-description">Pesanan Anda sedang dalam proses pembuatan</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon ${step3Status}">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">${step3Title}</div>
                                    <div class="timeline-description">${step3Desc}</div>
                                </div>
                            </div>
                        </div>

                        <div class="order-items">
                            <div class="order-items-title">Detail Pesanan:</div>
                            <div class="order-items-list">${itemsHtml}</div>
                        </div>

                        <div class="order-total">
                            <span class="total-label">Total Pembayaran:</span>
                            <span class="total-amount">Rp ${Number(order.total).toLocaleString('id-ID')}</span>
                        </div>
                    </div>
                `;
            }).join('');

            container.innerHTML = markup;
        }

        function fetchOrderHistory() {
            fetch('/api/orders/history', {
                headers: {
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.orders) {
                        renderOrderHistory(data.orders);
                    }
                })
                .catch(error => console.error('Error fetching order history:', error));
        }

        // Load cart count and order history on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
            fetchOrderHistory();
            setInterval(fetchOrderHistory, 5000);
        });
    </script>
</body>
</html>
