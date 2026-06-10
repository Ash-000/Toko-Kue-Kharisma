<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Pemesanan - Toko Kue Kharisma</title>
    @include('partials.font-styles')
    <style>
        /* Main */
        .riwayat-container {
            max-width: 900px;
            margin: 50px auto;
            margin-top: 120px;
            padding: 0 50px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 30px;
        }

        /* Order Card — sama dengan profile */
        .order-card {
            background: white;
            border-radius: var(--radius-md);
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid var(--color-brown);
            box-shadow: var(--shadow-sm);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .order-id { font-size: 16px; font-weight: 700; color: var(--color-text); }

        .order-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .status-completed  { background: #4caf50; color: white; }
        .status-processing { background: #ff9800; color: white; }
        .status-pending    { background: #9e9e9e; color: white; }
        .status-cancelled  { background: #d32f2f; color: white; }
        .status-shipping   { background: #2196f3; color: white; }
        .status-verified   { background: var(--color-brown); color: white; }

        .order-items { font-size: 14px; color: var(--color-text-mid); margin-bottom: 10px; }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
        }

        .order-date  { font-size: 13px; color: var(--color-brown); }
        .order-total { font-size: 16px; font-weight: 700; color: var(--color-text); }

        .btn-review {
            margin-top: 12px;
            width: 100%;
            padding: 10px;
            background: var(--color-brown);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }
        .btn-review:hover { background: var(--color-brown-dark); transform: translateY(-2px); }
        .btn-review svg { width: 16px; height: 16px; stroke: white; fill: none; stroke-width: 2; }

        /* Review Modal */
        .review-modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center; }
        .review-modal.active { display: flex; }
        .review-modal-content { background: white; border-radius: 20px; padding: 35px 30px; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: var(--shadow-lg); }
        .review-modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .review-modal-title { font-size: 22px; font-weight: 700; color: var(--color-text); }
        .btn-close-review { background: none; border: none; font-size: 26px; color: var(--color-brown); cursor: pointer; }
        .stars-input { display: flex; gap: 8px; font-size: 36px; margin-bottom: 20px; }
        .star { cursor: pointer; color: #e0e0e0; transition: color 0.2s; }
        .star.active { color: #ffd700; }
        .review-form-group { margin-bottom: 15px; }
        .review-form-group label { display: block; font-size: 14px; font-weight: 700; color: var(--color-text-mid); margin-bottom: 6px; }
        .review-form-control { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; color: var(--color-text); transition: border-color 0.3s; font-family: 'Nunito', sans-serif; }
        .review-form-control:focus { outline: none; border-color: var(--color-brown); }
        textarea.review-form-control { resize: vertical; min-height: 100px; }
        .btn-submit-review { width: 100%; background: var(--color-brown); color: white; border: none; padding: 14px; border-radius: 10px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s; margin-top: 10px; }
        .btn-submit-review:hover { background: var(--color-brown-dark); }

        /* Pagination */
        .pagination-container {
            margin-top: 30px;
            padding: 25px;
            background: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
        }

        .pagination-info {
            text-align: center;
            font-size: 14px;
            color: var(--color-text-light);
            margin-bottom: 15px;
        }

        .pagination-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .btn-page {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--color-brown);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-page:hover:not(:disabled) {
            background: var(--color-brown-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 115, 85, 0.3);
        }

        .btn-page:disabled {
            background: #ccc;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .btn-page svg {
            stroke: currentColor;
        }

        .page-numbers {
            padding: 10px 20px;
            background: #f5f5f0;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            color: var(--color-text);
        }

        @media (max-width: 1024px) {
            .riwayat-container {
                padding: 0 30px;
            }
        }

        @media (max-width: 768px) {
            .riwayat-container { padding: 0 20px; }
            .order-header { flex-direction: column; align-items: flex-start; gap: 8px; }

            .page-title {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .riwayat-container { 
                padding: 0 15px; 
                margin: 20px auto; 
                margin-top: 100px;
            }
            
            .page-title { 
                font-size: 22px; 
            }
            
            .order-card { 
                padding: 15px; 
            }

            .order-id {
                font-size: 15px;
            }

            .order-items {
                font-size: 13px;
            }

            .order-total {
                font-size: 15px;
            }

            .btn-review {
                font-size: 13px;
                padding: 9px;
            }

            .review-modal-content {
                padding: 25px 20px;
            }

            .review-modal-title {
                font-size: 20px;
            }

            .stars-input {
                font-size: 32px;
            }
        }
    </style>        
    @include('partials.notif-styles')
    @include('partials.auto-hide-navbar')
    @include('partials.enhanced-interactions')
</head>
<body style="overflow-x: hidden !important; max-width: 100vw !important; margin: 0 !important;">
    @include('partials.header')

    <!-- Main Content -->
    <div class="riwayat-container">
        <h1 class="page-title">Riwayat Pemesanan</h1>
        <div id="orderHistoryContainer">
        @forelse($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <span class="order-id">#{{ $order->order_number }}</span>
         @php
    $statusMap = [
        'pending'     => ['label' => 'Menunggu Pembayaran', 'class' => 'status-pending'],
        'verified'    => ['label' => 'Diverifikasi',        'class' => 'status-verified'],
        'in_progress' => ['label' => 'Diproses',            'class' => 'status-processing'],
        'shipping'    => ['label' => 'Dikirim',             'class' => 'status-shipping'],
        'completed'   => ['label' => 'Selesai',             'class' => 'status-completed'],
        'cancelled'   => ['label' => 'Dibatalkan',          'class' => 'status-cancelled'],
    ];
    $s = $statusMap[$order->status] ?? ['label' => ucfirst($order->status), 'class' => 'status-pending'];
@endphp
                <span class="order-status {{ $s['class'] }}">{{ $s['label'] }}</span>
            </div>

            <div class="order-items">
                @foreach($order->orderItems as $item)
                    {{ $item->quantity }}x {{ $item->product->name ?? '-' }}<br>
                @endforeach
            </div>

            <div class="order-footer">
                <span class="order-date">{{ $order->created_at->format('d F Y') }}</span>
                <span class="order-total">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>

            @if($order->status === 'completed')
            @if(in_array($order->order_number, $reviewedOrders))
            <div style="margin-top:12px;padding:10px;background:#f5f5f0;border-radius:10px;text-align:center;font-size:14px;color:#8b7355;font-weight:600;">
                Sudah diberi ulasan
            </div>
            @else
            <button class="btn-review" onclick="openReviewModal('{{ $order->order_number }}')">
                <svg viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                Beri Ulasan
            </button>
            @endif
            @endif
        </div>
        @empty
        <div style="text-align:center;padding:60px 20px;background:white;border-radius:20px;">
            <svg viewBox="0 0 24 24" style="width:80px;height:80px;stroke:#d4b896;fill:none;stroke-width:1.5;margin-bottom:20px;">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <h3 style="font-size:20px;color:#2c2c2c;margin-bottom:10px;">Belum Ada Pesanan</h3>
            <p style="font-size:15px;color:#6b6b6b;margin-bottom:20px;">Anda belum memiliki riwayat pesanan</p>
            <button onclick="window.location.href='/menu'" style="background:#8b7355;color:white;border:none;padding:12px 30px;border-radius:25px;font-size:15px;font-weight:600;cursor:pointer;">Mulai Belanja</button>
        </div>
        @endforelse

        {{-- Pagination --}}
        @if($orders->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $orders->firstItem() }} - {{ $orders->lastItem() }} dari {{ $orders->total() }} pesanan
            </div>
            <div class="pagination-buttons">
                @if($orders->onFirstPage())
                    <button class="btn-page" disabled>
                        <svg viewBox="0 0 24 24" width="18" height="18">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" fill="none" stroke-width="2"/>
                        </svg>
                        Prev
                    </button>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" class="btn-page">
                        <svg viewBox="0 0 24 24" width="18" height="18">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" fill="none" stroke-width="2"/>
                        </svg>
                        Prev
                    </a>
                @endif

                <span class="page-numbers">
                    Halaman {{ $orders->currentPage() }} dari {{ $orders->lastPage() }}
                </span>

                @if($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}" class="btn-page">
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

     

        // Load cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
        });
    </script>

    <!-- Review Modal -->
    <div class="review-modal" id="reviewModal">
        <div class="review-modal-content">
            <div class="review-modal-header">
                <h2 class="review-modal-title">Beri Ulasan</h2>
                <button class="btn-close-review" onclick="closeReviewModal()">×</button>
            </div>

            <p style="font-size:13px;color:#8b7355;margin-bottom:15px;" id="reviewOrderLabel"></p>

            <div>
                <label style="font-size:14px;font-weight:600;color:#4a4a4a;display:block;margin-bottom:8px;">Rating</label>
                <div class="stars-input" id="starsInput">
                    <span class="star" onclick="setRating(1)">★</span>
                    <span class="star" onclick="setRating(2)">★</span>
                    <span class="star" onclick="setRating(3)">★</span>
                    <span class="star" onclick="setRating(4)">★</span>
                    <span class="star" onclick="setRating(5)">★</span>
                </div>
                <input type="hidden" id="ratingValue" value="0">
            </div>

            <div class="review-form-group">
                <label for="reviewName">Nama</label>
                <input type="text" id="reviewName" class="review-form-control" placeholder="Nama Anda" value="{{ auth()->user()->name ?? '' }}">
            </div>

            <div class="review-form-group">
                <label for="reviewText">Ulasan</label>
                <textarea id="reviewText" class="review-form-control" placeholder="Ceritakan pengalaman Anda..."></textarea>
            </div>

            <button class="btn-submit-review" onclick="submitReview()">Kirim Ulasan</button>
        </div>
    </div>

    <script>
        let currentOrderNumber = '';

        function openReviewModal(orderNumber) {
            currentOrderNumber = orderNumber;
            document.getElementById('reviewOrderLabel').textContent = 'Pesanan #' + orderNumber;
            document.getElementById('reviewModal').classList.add('active');
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.remove('active');
            document.getElementById('reviewText').value = '';
            document.getElementById('ratingValue').value = '0';
            document.querySelectorAll('.star').forEach(s => s.classList.remove('active'));
            currentOrderNumber = '';
        }

        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) closeReviewModal();
        });

        function setRating(rating) {
            document.getElementById('ratingValue').value = rating;
            document.querySelectorAll('.star').forEach((star, i) => {
                star.classList.toggle('active', i < rating);
            });
        }

        function submitReview() {
            const rating = document.getElementById('ratingValue').value;
            const name   = document.getElementById('reviewName').value.trim();
            const review = document.getElementById('reviewText').value.trim();

            if (rating === '0') { alert('Silakan pilih rating terlebih dahulu!'); return; }
            if (!name)          { alert('Nama tidak boleh kosong.'); return; }
            if (!review)        { alert('Ulasan tidak boleh kosong.'); return; }

            const btn = document.querySelector('.btn-submit-review');
            btn.textContent = 'Mengirim...';
            btn.disabled = true;

            fetch('/reviews', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, rating: parseInt(rating), review, order_number: currentOrderNumber })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    closeReviewModal();
                    showNotif('Ulasan berhasil dikirim. Terima kasih!', 'success');
                } else {
                    showNotif(data.message || 'Gagal mengirim ulasan.', 'error');
                }
            })
            .catch(() => showNotif('Terjadi kesalahan, coba lagi.', 'error'))
            .finally(() => { btn.textContent = 'Kirim Ulasan'; btn.disabled = false; });
        }

        function showNotif(message, type) {
            const el = document.createElement('div');
            el.style.cssText = `position:fixed;top:100px;right:30px;background:${type==='success'?'#4caf50':'#f44336'};color:white;padding:15px 25px;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,0.3);z-index:10000;font-weight:600;`;
            el.textContent = message;
            document.body.appendChild(el);
            setTimeout(() => el.remove(), 3500);
        }
    </script>
    @include('partials.notif-scripts')
    
    {{-- Bottom Navigation (Mobile) --}}
    @include('partials.bottom-nav')
</body>
</html>
