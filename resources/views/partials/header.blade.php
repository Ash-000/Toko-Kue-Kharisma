{{-- Partial: Main Navigation Header --}}
<!-- Menu Overlay -->
<div class="menu-overlay" id="menuOverlay"></div>

<!-- Header -->
<header>
    <div class="header-left">
        @if(isset($showBackButton) && $showBackButton)
        <a href="{{ $backUrl ?? '/' }}" class="btn-back">
            <svg viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            <span>Kembali</span>
        </a>
        @endif
        <div class="logo-section">
            <span class="store-name">Toko Kue Kharisma</span>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav id="navMenu">
        <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
        <a href="/menu" class="{{ Request::is('menu') ? 'active' : '' }}">Menu</a>
        <a href="/riwayat" class="{{ Request::is('riwayat') ? 'active' : '' }}">Riwayat</a>
        <a href="/kontak" class="{{ Request::is('kontak') ? 'active' : '' }}">Kontak</a>
    </nav>
    
    <div class="header-icons">
        @include('partials.header-icons')
        
        <div class="icon-wrapper">
            <button class="icon-btn" title="Keranjang" onclick="window.location.href='/cart'">
                <svg viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span class="cart-badge" id="cartBadge">{{ $cartCount ?? 0 }}</span>
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
