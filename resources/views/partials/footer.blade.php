{{-- Footer Section --}}
<style>
    .site-footer {
        background: linear-gradient(135deg, #3d2f24 0%, #2c2118 100%);
        color: #d4b896;
        padding: 50px 20px 30px;
        margin-top: 60px;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-brand {
        text-align: center;
        margin-bottom: 40px;
    }

    .footer-logo {
        font-size: 32px;
        color: #d4b896;
        font-style: italic;
        margin-bottom: 10px;
    }

    .footer-tagline {
        color: #a89176;
        font-size: 14px;
        font-style: italic;
    }

    .footer-nav {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 30px;
        margin-bottom: 40px;
        padding: 30px 0;
        border-top: 1px solid rgba(212, 184, 150, 0.2);
        border-bottom: 1px solid rgba(212, 184, 150, 0.2);
    }

    .footer-nav a {
        color: #d4b896;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        transition: color 0.25s ease;
    }

    .footer-nav a:hover {
        color: #f5deb3;
    }

    .footer-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .footer-section h3 {
        color: #f5deb3;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .footer-section p,
    .footer-section a {
        color: #a89176;
        font-size: 14px;
        line-height: 1.8;
        text-decoration: none;
        display: block;
        transition: color 0.25s ease;
    }

    .footer-section a:hover {
        color: #d4b896;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 30px;
    }

    .footer-bottom {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid rgba(212, 184, 150, 0.2);
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(212, 184, 150, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d4b896;
        text-decoration: none;
        transition: all 0.25s ease;
        border: 1px solid rgba(212, 184, 150, 0.3);
    }

    .social-link:hover {
        background: #d4b896;
        color: #2c2118;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(212, 184, 150, 0.3);
    }

    .social-link svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .footer-copyright {
        color: #8b7355;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .footer-heart {
        color: #d32f2f;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .site-footer {
            padding: 40px 16px 90px;
        }

        .footer-logo {
            font-size: 26px;
        }

        .footer-nav {
            gap: 20px;
        }

        .footer-nav a {
            font-size: 14px;
        }

        .footer-info {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .footer-section {
            text-align: center;
        }
    }
</style>

<footer class="site-footer">
    <div class="footer-container">
        {{-- Brand --}}
        <div class="footer-brand">
            <h2 class="footer-logo">Toko Kue Kharisma</h2>
            <p class="footer-tagline">Kue tradisional lezat dari Dramaga, Bogor</p>
        </div>

        {{-- Footer Info Sections --}}
        <div class="footer-info">
            {{-- Alamat --}}
            <div class="footer-section">
                <h3>Alamat</h3>
                <p>Jl. Pasar Dramaga No.74<br>
                   RT.002/RW.003, Dramaga<br>
                   Kec. Dramaga, Bogor Barat<br>
                   Jawa Barat 16680</p>
            </div>

            {{-- Kontak --}}
            <div class="footer-section">
                <h3>Hubungi Kami</h3>
                <a href="https://wa.me/6289636491354" target="_blank">WhatsApp: 0896-3649-1354</a>
                <a href="mailto:kuekharisma@gmail.com">Email: kuekharisma@gmail.com</a>
            </div>

            {{-- Jam Buka --}}
            <div class="footer-section">
                <h3>Jam Buka</h3>
                <p>Senin - Sabtu: 08:00 - 20:00<br>
                   Minggu: 09:00 - 18:00</p>
            </div>
        </div>

        {{-- Social Links --}}
        <div class="social-links">
            <a href="https://wa.me/6289636491354" target="_blank" class="social-link" title="WhatsApp">
                <svg viewBox="0 0 24 24">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                </svg>
            </a>
            <a href="mailto:kuekharisma@gmail.com" class="social-link" title="Email">
                <svg viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </a>
            <a href="https://www.google.com/maps/dir/?api=1&destination=Jl.+Pasar+Dramaga+No.74%2C+RT.002%2FRW.003%2C+Dramaga%2C+Kec.+Dramaga%2C+Bogor+Barat%2C+Jawa+Barat+16680" target="_blank" class="social-link" title="Google Maps">
                <svg viewBox="0 0 24 24">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
            </a>
        </div>

        {{-- Copyright --}}
        <div class="footer-bottom">
            <p class="footer-copyright">
                © 2026 Toko Kue Kharisma · Dibuat dengan <span class="footer-heart">❤</span>
            </p>
        </div>
    </div>
</footer>
