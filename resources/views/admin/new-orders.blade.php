<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesanan Baru - Admin</title>
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

        .store-name {
            font-family: 'Brush Script MT', cursive;
            font-size: 28px;
            color: #2c2c2c;
            font-style: italic;
            font-weight: bold;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 50px;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        /* Orders List */
        .orders-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c2c2c;
        }

        .badge-new {
            background: #ff9800;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .badge-new svg {
            width: 18px;
            height: 18px;
            fill: white;
        }

        .order-card {
            background: #f5f5f0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            position: relative;
            transition: all 0.3s;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .bell-icon {
            width: 40px;
            height: 40px;
            background: #fff3e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: ring 2s infinite;
        }

        @keyframes ring {
            0%, 100% { transform: rotate(0deg); }
            10%, 30% { transform: rotate(-10deg); }
            20%, 40% { transform: rotate(10deg); }
        }

        .bell-icon svg {
            width: 22px;
            height: 22px;
            fill: #ff9800;
        }

        .order-info {
            flex: 1;
        }

        .order-number {
            font-size: 16px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 3px;
        }

        .order-customer {
            font-size: 14px;
            color: #6b6b6b;
        }

        .order-items {
            margin: 15px 0;
            padding-left: 20px;
        }

        .order-items li {
            font-size: 14px;
            color: #4a4a4a;
            margin-bottom: 5px;
        }

        .order-total {
            font-size: 16px;
            font-weight: 600;
            color: #8b7355;
            margin: 10px 0;
        }

        .btn-verify {
            background: #4caf50;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-verify:hover {
            background: #388e3c;
            transform: translateY(-2px);
        }

        .btn-verify:disabled {
            background: #9e9e9e;
            cursor: not-allowed;
            transform: none;
        }

        /* Phone Preview */
        .phone-preview {
            position: sticky;
            top: 30px;
        }

        .phone-mockup {
            background: #2c2c2c;
            border-radius: 40px;
            padding: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .phone-screen {
            background: #e5ddd5;
            border-radius: 25px;
            overflow: hidden;
            height: 600px;
        }

        .whatsapp-header {
            background: #075e54;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .wa-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #d4b896;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wa-avatar svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        .wa-info {
            flex: 1;
        }

        .wa-name {
            color: white;
            font-size: 16px;
            font-weight: 600;
        }

        .wa-status {
            color: #d4d4d4;
            font-size: 12px;
        }

        .wa-chat {
            padding: 20px;
            height: calc(600px - 70px);
            overflow-y: auto;
        }

        .wa-message {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .wa-message-title {
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 10px;
        }

        .wa-message-text {
            font-size: 13px;
            color: #4a4a4a;
            line-height: 1.6;
            white-space: pre-line;
        }

        .wa-time {
            font-size: 11px;
            color: #999;
            text-align: right;
            margin-top: 5px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            stroke: #d4b896;
            fill: none;
            stroke-width: 1.5;
            margin-bottom: 20px;
        }

        @media (max-width: 968px) {
            .container {
                grid-template-columns: 1fr;
            }

            .phone-preview {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-left">
            <a href="/admin" class="btn-back">
                <svg viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
            <span class="store-name">Toko kue kharisma</span>
        </div>
    </header>

    <!-- Container -->
    <div class="container">
        <!-- Orders List -->
        <div class="orders-section">
            <div class="section-header">
                <h1 class="page-title">Pesanan Admin</h1>
                <div class="badge-new">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    {{ $newOrdersCount }} pesan baru
                </div>
            </div>

            @forelse($newOrders as $order)
            <div class="order-card" data-order-id="{{ $order->id }}">
                <div class="order-header">
                    <div class="bell-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                    <div class="order-info">
                        <div class="order-number">No. Pesanan: {{ $order->order_number }}</div>
                        <div class="order-customer">Nama: {{ $order->user->name }}</div>
                    </div>
                </div>

                <div class="order-items">
                    <strong>Pesanan:</strong>
                    <ul>
                        @foreach($order->orderItems as $item)
                        <li>{{ $item->product->name }} ({{ $item->quantity }})</li>
                        @endforeach
                    </ul>
                </div>

                <div class="order-total">
                    Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                </div>

                <button class="btn-verify" onclick="verifyOrder({{ $order->id }}, '{{ $order->user->name }}', '{{ $order->order_number }}')">
                    verifikasi
                </button>
            </div>
            @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
                <p>Tidak ada pesanan baru</p>
            </div>
            @endforelse
        </div>

        <!-- Phone Preview -->
        <div class="phone-preview">
            <div class="phone-mockup">
                <div class="phone-screen">
                    <div class="whatsapp-header">
                        <div class="wa-avatar">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                        </div>
                        <div class="wa-info">
                            <div class="wa-name">Toko Kue Kharisma</div>
                            <div class="wa-status">online</div>
                        </div>
                    </div>
                    <div class="wa-chat" id="waChat">
                        <div class="wa-message">
                            <div class="wa-message-title">Preview Notifikasi WhatsApp</div>
                            <div class="wa-message-text">Klik tombol "verifikasi" untuk mengirim notifikasi ke customer</div>
                            <div class="wa-time">11:10</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function verifyOrder(orderId, customerName, orderNumber) {
            if (!confirm(`Verifikasi pesanan dari ${customerName}?`)) {
                return;
            }

            const btn = event.target;
            btn.disabled = true;
            btn.textContent = 'Memproses...';

            fetch(`/admin/orders/${orderId}/verify`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show WhatsApp preview
                    showWhatsAppPreview(data.order);

                    // Remove order card
                    const card = document.querySelector(`[data-order-id="${orderId}"]`);
                    card.style.animation = 'slideOut 0.3s ease-out';
                    
                    setTimeout(() => {
                        card.remove();
                        
                        // Update badge count
                        const badge = document.querySelector('.badge-new');
                        const currentCount = parseInt(badge.textContent.match(/\d+/)[0]);
                        const newCount = currentCount - 1;
                        badge.innerHTML = `
                            <svg viewBox="0 0 24 24">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            ${newCount} pesan baru
                        `;

                        // Open WhatsApp
                        window.open(data.whatsapp_url, '_blank');

                        // Check if no more orders
                        if (newCount === 0) {
                            location.reload();
                        }
                    }, 300);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memverifikasi pesanan');
                btn.disabled = false;
                btn.textContent = 'verifikasi';
            });
        }

        function showWhatsAppPreview(order) {
            const items = order.order_items.map(item => 
                `- ${item.product.name} (${item.quantity})`
            ).join('\n');

            const message = `*Pesanan Baru Masuk!*\n\n` +
                `Nama: ${order.user.name}\n` +
                `No Pesanan: #${order.order_number}\n\n` +
                `Pesanan:\n${items}\n\n` +
                `Total: Rp ${new Intl.NumberFormat('id-ID').format(order.total)}\n\n` +
                `Segera verifikasi pesanan di dashboard.\n\n` +
                `_Terima kasih telah berbelanja di Toko Kue Kharisma!_`;

            const waChat = document.getElementById('waChat');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'wa-message';
            messageDiv.innerHTML = `
                <div class="wa-message-title">Pesanan Baru Masuk!</div>
                <div class="wa-message-text">${message.replace(/\n/g, '<br>')}</div>
                <div class="wa-time">${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}</div>
            `;
            
            waChat.appendChild(messageDiv);
            waChat.scrollTop = waChat.scrollHeight;
        }

        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                to {
                    opacity: 0;
                    transform: translateX(-100%);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
