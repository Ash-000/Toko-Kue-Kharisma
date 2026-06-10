<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Kontak - Toko Kue Kharisma</title>
    @include('partials.font-styles')
    <link rel="stylesheet" href="/css/main.css">
    <style>
        /* Page Title */
        .page-title {
            text-align: center;
            padding: 100px 20px 0;
        }

        .page-title h1 {
            font-size: 36px;
            font-weight: 800;
            color: var(--color-text);
            display: inline-flex;
            align-items: center;
            gap: 15px;
            position: relative;
            padding-bottom: 14px;
        }

        .page-title h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--color-accent), var(--color-accent-soft));
            border-radius: 2px;
        }

        .page-title h1 svg {
            width: 40px;
            height: 40px;
            stroke: var(--color-accent);
            fill: none;
            stroke-width: 2;
        }

        /* Contact Container */
        .contact-container {
            max-width: 1200px;
            margin: 50px auto 80px;
            padding: 0 50px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        /* Left Column */
        .contact-left {
            display: flex;
            flex-direction: column;
        }

        .contact-form {
            background: var(--color-white);
            border-radius: var(--radius-xl);
            padding: 36px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            color: var(--color-text);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #ebebeb;
            border-radius: var(--radius-md);
            background: var(--color-bg);
            font-size: 15px;
            color: var(--color-text);
            transition: border-color 0.3s, box-shadow 0.3s;
            font-family: 'Nunito', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-accent);
            box-shadow: 0 0 0 3px rgba(224, 123, 57, 0.1);
            background: var(--color-white);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 140px;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-soft) 100%);
            color: white;
            border: none;
            padding: 14px 40px;
            border-radius: var(--radius-full);
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            margin-top: 8px;
            box-shadow: var(--shadow-accent);
            font-family: 'Nunito', sans-serif;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(224, 123, 57, 0.35);
        }

        .btn-submit svg {
            width: 20px;
            height: 20px;
            stroke: white;
            fill: none;
            stroke-width: 2;
        }

        /* Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .info-card {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            background: var(--color-white);
            padding: 22px 24px;
            border-radius: var(--radius-xl);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-soft) 100%);
            border-radius: var(--radius-md);
            box-shadow: 0 4px 12px rgba(224, 123, 57, 0.2);
        }

        .info-icon svg {
            width: 24px;
            height: 24px;
            stroke: white;
            fill: none;
            stroke-width: 2;
        }

        .info-details {
            flex: 1;
            min-width: 0;
        }

        .info-label {
            font-size: 11px;
            color: var(--color-accent);
            font-weight: 800;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .info-text {
            font-size: 14px;
            color: var(--color-text);
            line-height: 1.6;
            font-weight: 600;
        }

        .info-note {
            font-size: 12px;
            color: var(--color-accent);
            margin-top: 6px;
            line-height: 1.5;
            font-weight: 600;
        }

        .address-card {
            text-decoration: none;
        }

        .address-card .info-text {
            word-break: break-word;
        }

        @media (max-width: 1024px) {
            .contact-container {
                gap: 30px;
                padding: 0 30px;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                padding: 90px 20px 0;
            }

            .page-title h1 {
                font-size: 28px;
            }

            .page-title h1 svg {
                width: 32px;
                height: 32px;
            }

            .contact-container {
                grid-template-columns: 1fr;
                padding: 0 20px;
                margin-top: 30px;
                gap: 24px;
            }

            .contact-form {
                padding: 28px 20px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                padding: 80px 15px 0;
            }

            .page-title h1 {
                font-size: 24px;
                gap: 10px;
            }

            .page-title h1 svg {
                width: 28px;
                height: 28px;
            }

            .contact-container {
                padding: 0 15px;
                margin: 25px auto;
            }

            .contact-form {
                padding: 20px 15px;
            }

            .form-control {
                padding: 12px 15px;
                font-size: 14px;
            }

            .btn-submit {
                padding: 12px 35px;
                font-size: 14px;
            }

            .info-card {
                padding: 16px;
                gap: 14px;
            }

            .info-icon {
                width: 44px;
                height: 44px;
            }

            .info-icon svg {
                width: 22px;
                height: 22px;
            }

            .info-text {
                font-size: 13px;
            }
        }
    </style>
    @include('partials.notif-styles')
    @include('partials.auto-hide-navbar')
    @include('partials.enhanced-interactions')
</head>
<body style="overflow-x: hidden !important; max-width: 100vw !important; margin: 0 !important;">
    @include('partials.header')

    <!-- Page Title -->
    <div class="page-title">
        <h1>
            <svg viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            Kontak Kami
        </h1>
    </div>

    <!-- Contact Container -->
    <div class="contact-container">
        <!-- Contact Form -->
        <div class="contact-left">
            <div class="contact-form">
                <form onsubmit="sendMessage(event)">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea id="message" class="form-control" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                        </svg>
                        Kirim pesan via WhatsApp
                    </button>
                </form>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="contact-info">
            <!-- Address -->
            <a href="https://www.google.com/maps/dir/?api=1&destination=Jl.+Pasar+Dramaga+No.74%2C+RT.002%2FRW.003%2C+Dramaga%2C+Kec.+Dramaga%2C+Bogor+Barat%2C+Jawa+Barat+16680" target="_blank" rel="noopener noreferrer" class="info-card address-card">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <div class="info-details">
                    <p class="info-label">Alamat</p>
                    <p class="info-text">
                        Jl. Pasar Dramaga No.74, RT.002/RW.003, Dramaga, Kec. Dramaga, Bogor Barat, Jawa Barat 16680
                    </p>
                    <p class="info-note">Klik alamat untuk membuka Google Maps dengan tujuan alamat ini.</p>
                </div>
            </a>

            <!-- Email -->
            <div class="info-card">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div class="info-details">
                    <p class="info-label">Email</p>
                    <p class="info-text">kuekharisma@gmail.com</p>
                </div>
            </div>

            <!-- Business Hours -->
            <div class="info-card">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12,6 12,12 16,14"></polyline>
                    </svg>
                </div>
                <div class="info-details">
                    <p class="info-label">Jam Buka</p>
                    <p class="info-text">
                        Senin - Sabtu: 08:00 - 20:00<br>
                        Minggu: 09:00 - 18:00
                    </p>
                </div>
            </div>
        </div>
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

        // Send Message
        function sendMessage(event) {
            event.preventDefault();

            const phoneNumber = '6289636491354';
            const name = document.getElementById('name').value.trim();
            const message = document.getElementById('message').value.trim();

            const whatsappText = `Halo, saya ${name}.\n\nPesan: ${message}`;
            const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(whatsappText)}`;

            window.open(whatsappURL, '_blank');
            event.target.reset();
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
    @include('partials.notif-scripts')
    
    {{-- Bottom Navigation (Mobile) --}}
    @include('partials.bottom-nav')
</body>
</html>
