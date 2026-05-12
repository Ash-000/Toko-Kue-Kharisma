<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran - Toko Kue Kharisma</title>
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
            padding: 15px clamp(15px, 4vw, 50px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
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
            font-family: 'Brush Script MT', 'Lucida Handwriting', cursive;
            font-size: 28px;
            color: #2c2c2c;
            font-style: italic;
            font-weight: bold;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Payment Container */
        .payment-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 50px;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        .payment-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 30px;
        }

        /* Payment Methods */
        .payment-methods {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .method-section {
            margin-bottom: 30px;
        }

        .method-section:last-child {
            margin-bottom: 0;
        }

        .method-title {
            font-size: 16px;
            font-weight: 600;
            color: #4a4a4a;
            margin-bottom: 15px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-option:hover {
            border-color: #8b7355;
            background: #f5f5f0;
        }

        .payment-option.selected {
            border-color: #8b7355;
            background: #f5f5f0;
        }

        .payment-option input[type="radio"] {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            cursor: pointer;
        }

        .payment-logo {
            width: 50px;
            height: 30px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            color: white;
            border-radius: 5px;
        }

        .payment-name {
            flex: 1;
            font-size: 15px;
            font-weight: 600;
            color: #2c2c2c;
        }

        /* Order Summary */
        .order-summary {
            background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 20px;
        }

        .summary-items {
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #4a4a4a;
        }

        .summary-divider {
            height: 1px;
            background: rgba(44, 44, 44, 0.2);
            margin: 20px 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 20px;
        }

        .btn-pay {
            width: 100%;
            background: #2c2c2c;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-pay:hover {
            background: #000;
            transform: translateY(-2px);
        }

        .btn-pay:disabled {
            background: #9e9e9e;
            cursor: not-allowed;
            transform: none;
        }

        /* QRIS Modal */
        .qris-modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .qris-modal.active { display: flex; }

        .qris-content {
            background: white;
            border-radius: 20px;
            padding: 35px 30px;
            max-width: 380px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            animation: bounceIn 0.4s ease-out;
        }

        .qris-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        .qris-logo span {
            font-size: 22px;
            font-weight: 800;
            color: #e2231a;
            letter-spacing: 1px;
        }

        .qris-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 4px;
        }
        .qris-amount {
            font-size: 22px;
            font-weight: 700;
            color: #8b7355;
            margin-bottom: 16px;
        }

        .qris-img-wrapper {
            background: #f9f9f9;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #qrisCanvas {
            width: 220px;
            height: 220px;
            display: block;
        }

        .qris-timer {
            font-size: 13px;
            color: #888;
            margin-bottom: 6px;
        }
        .qris-timer span {
            font-weight: 700;
            color: #d32f2f;
        }

        .qris-status {
            font-size: 14px;
            color: #555;
            margin-bottom: 16px;
            min-height: 20px;
        }

        .qris-status.paid {
            color: #2e7d32;
            font-weight: 700;
            font-size: 16px;
        }

        .btn-qris-cancel {
            background: none;
            border: 1px solid #ccc;
            color: #888;
            padding: 9px 28px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-qris-cancel:hover { background: #f5f5f5; }

        /* Success Modal */
        .success-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .success-modal.active {
            display: flex;
        }

        .success-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: bounceIn 0.5s ease-out;
        }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }

        .success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-icon svg {
            width: 50px;
            height: 50px;
            stroke: #4caf50;
            fill: none;
            stroke-width: 3;
        }

        .success-title {
            font-size: 22px;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 10px;
        }

        .success-message {
            font-size: 15px;
            color: #6b6b6b;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .btn-view-order {
            background: #4caf50;
            color: white;
            border: none;
            padding: 12px 40px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-view-order:hover {
            background: #388e3c;
            transform: translateY(-2px);
        }

        @media (max-width: 968px) {
            .payment-container {
                grid-template-columns: 1fr;
                padding: 0 20px;
            }

            .order-summary {
                position: static;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-left">
            <a href="/cart" class="btn-back">
                <svg viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
            <span class="store-name">Toko kue kharisma</span>
        </div>
    </header>

    <!-- Payment Container -->
    <div class="payment-container">
        <!-- Payment Methods -->
        <div>
            <h1 class="payment-title">Pilih Metode Pembayaran</h1>

            <div class="payment-methods">
                <!-- E-Wallet -->
                <div class="method-section">
                    <div class="method-title">E-Wallet</div>
                    
                    <label class="payment-option">
                        <input type="radio" name="payment" value="qris" onchange="selectPayment(this)">
                        <div class="payment-logo" style="background: #8b7355;">QR</div>
                        <span class="payment-name">QRIS (Scan QR)</span>
                    </label>
                </div>

                <!-- Bank Transfer -->
                <div class="method-section">
                    <div class="method-title">Transfer Bank</div>
                    
                    <label class="payment-option">
                        <input type="radio" name="payment" value="bank_transfer" onchange="selectPayment(this)">
                        <div class="payment-logo" style="background: #2196F3;">🏦</div>
                        <span class="payment-name">Transfer Bank (Manual)</span>
                    </label>
                </div>

                <!-- COD -->
                <div class="method-section">
                    <div class="method-title">Bayar di Tempat</div>
                    
                    <label class="payment-option">
                        <input type="radio" name="payment" value="cod" onchange="selectPayment(this)">
                        <div class="payment-logo" style="background: #4caf50;">COD</div>
                        <span class="payment-name">Cash on Delivery (Bayar di Tempat)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2 class="summary-title">Ringkasan Pesanan</h2>
            
            <div class="summary-items">
                <div class="summary-item">
                    <span>Subtotal</span>
                    <span id="summarySubtotal">-</span>
                </div>
                <div class="summary-item">
                    <span>Ongkos Kirim</span>
                    <span>Gratis</span>
                </div>
                <div class="summary-item">
                    <span>Diskon</span>
                    <span style="color: #d32f2f;">- Rp 0</span>
                </div>
            </div>

            <div class="summary-divider"></div>

            <div class="summary-total">
                <span>Total Pembayaran</span>
                <span id="summaryTotal">-</span>
            </div>

            <button class="btn-pay" id="btnPay" disabled onclick="processPayment()">
                Bayar Sekarang
            </button>
        </div>
    </div>

    <!-- QRIS Modal -->
    <div class="qris-modal" id="qrisModal">
        <div class="qris-content">
            <div class="qris-logo">
                <span>QRIS</span>
            </div>
            <div class="qris-title">Scan QR untuk Membayar</div>
            <div class="qris-amount" id="qrisAmount">-</div>

            <div class="qris-img-wrapper">
                <canvas id="qrisCanvas"></canvas>
            </div>

            <div class="qris-timer">Berlaku selama <span id="qrisCountdown">15:00</span></div>
            <div class="qris-status" id="qrisStatus">Menunggu pembayaran...</div>

            <button class="btn-qris-cancel" id="btnQrisCancel" onclick="closeQrisModal()">Batal</button>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="success-modal" id="successModal">
        <div class="success-content">
            <div class="success-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="8 12 11 15 16 9"></polyline>
                </svg>
            </div>
            <h3 class="success-title">Pembayaran Berhasil!</h3>
            <p class="success-message">
                Pesanan Anda telah dikonfirmasi dan sedang diproses. Terima kasih telah berbelanja di toko kami!
            </p>
            <button class="btn-view-order" onclick="window.location.href='/riwayat'">
                Lihat Pesanan
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        let selectedPaymentMethod = null;
        let qrisPollingInterval   = null;
        let qrisCountdownInterval = null;
        let currentOrderNumber    = null;
        let qrCodeInstance        = null;

        // Load cart summary on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/cart/summary', { headers: { 'Accept': 'application/json' } })
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.data) {
                        const subtotal = data.data.total_price;
                        const total    = subtotal;
                        document.getElementById('summarySubtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
                        document.getElementById('summaryTotal').textContent    = 'Rp ' + total.toLocaleString('id-ID');
                    }
                })
                .catch(() => {});
        });

        function selectPayment(radio) {
            selectedPaymentMethod = radio.value;
            document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
            radio.closest('.payment-option').classList.add('selected');
            document.getElementById('btnPay').disabled = false;
        }

        function processPayment() {
            if (!selectedPaymentMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu');
                return;
            }

            const btnPay = document.getElementById('btnPay');
            btnPay.textContent = 'Memproses...';
            btnPay.disabled    = true;

            fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ payment_method: selectedPaymentMethod }),
            })
            .then(res => res.json())
            .then(data => {
                btnPay.textContent = 'Bayar Sekarang';
                btnPay.disabled    = false;

                if (!data.success) {
                    alert(data.message || 'Gagal membuat pesanan');
                    return;
                }

                if (selectedPaymentMethod === 'qris' && (data.qr_string || data.qr_url)) {
                    // Tampilkan modal QR — pakai qr_string untuk render lokal
                    showQrisModal(data.qr_string || data.qr_url, data.total, data.order_number);
                } else if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    document.getElementById('successModal').classList.add('active');
                }
            })
            .catch(() => {
                alert('Terjadi kesalahan, silakan coba lagi');
                btnPay.textContent = 'Bayar Sekarang';
                btnPay.disabled    = false;
            });
        }

        // ── QRIS Modal ──────────────────────────────────────────────
        function showQrisModal(qrString, total, orderNumber) {
            currentOrderNumber = orderNumber;

            document.getElementById('qrisAmount').textContent = 'Rp ' + Number(total).toLocaleString('id-ID');
            document.getElementById('qrisStatus').textContent = 'Menunggu pembayaran...';
            document.getElementById('qrisStatus').className   = 'qris-status';
            document.getElementById('btnQrisCancel').style.display = '';
            document.getElementById('qrisModal').classList.add('active');

            // Generate QR dari qr_string
            const canvas = document.getElementById('qrisCanvas');
            canvas.width  = 220;
            canvas.height = 220;

            // Hapus QR lama kalau ada
            if (qrCodeInstance) {
                qrCodeInstance.clear();
                qrCodeInstance = null;
            }
            canvas.getContext('2d').clearRect(0, 0, 220, 220);

            qrCodeInstance = new QRCode(canvas, {
                text:           qrString,
                width:          220,
                height:         220,
                colorDark:      '#000000',
                colorLight:     '#ffffff',
                correctLevel:   QRCode.CorrectLevel.M,
            });

            startQrisCountdown(15 * 60);
            startQrisPolling(orderNumber);
        }

        function closeQrisModal() {
            document.getElementById('qrisModal').classList.remove('active');
            stopQrisPolling();
            stopQrisCountdown();
        }

        function startQrisCountdown(seconds) {
            stopQrisCountdown();
            let remaining = seconds;
            const el = document.getElementById('qrisCountdown');

            qrisCountdownInterval = setInterval(() => {
                remaining--;
                const m = String(Math.floor(remaining / 60)).padStart(2, '0');
                const s = String(remaining % 60).padStart(2, '0');
                el.textContent = m + ':' + s;

                if (remaining <= 0) {
                    stopQrisCountdown();
                    stopQrisPolling();
                    document.getElementById('qrisStatus').textContent = 'QR kadaluarsa. Silakan buat pesanan baru.';
                    document.getElementById('btnQrisCancel').textContent = 'Tutup';
                }
            }, 1000);
        }

        function stopQrisCountdown() {
            if (qrisCountdownInterval) {
                clearInterval(qrisCountdownInterval);
                qrisCountdownInterval = null;
            }
        }

        function startQrisPolling(orderNumber) {
            stopQrisPolling();
            // Cek tiap 5 detik
            qrisPollingInterval = setInterval(() => {
                fetch('/api/order/' + orderNumber + '/status', {
                    headers: { 'Accept': 'application/json' }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'paid' || data.status === 'in_progress' || data.status === 'verified') {
                        stopQrisPolling();
                        stopQrisCountdown();

                        const statusEl = document.getElementById('qrisStatus');
                        statusEl.textContent = '✅ Pembayaran berhasil!';
                        statusEl.className   = 'qris-status paid';
                        document.getElementById('btnQrisCancel').style.display = 'none';

                        // Redirect ke riwayat setelah 2 detik
                        setTimeout(() => {
                            window.location.href = '/riwayat';
                        }, 2000);
                    }
                })
                .catch(() => {});
            }, 5000);
        }

        function stopQrisPolling() {
            if (qrisPollingInterval) {
                clearInterval(qrisPollingInterval);
                qrisPollingInterval = null;
            }
        }
    </script>
</body>
</html>
