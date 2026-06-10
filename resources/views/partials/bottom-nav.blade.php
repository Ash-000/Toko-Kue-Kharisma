{{-- Bottom Navigation Bar (Mobile Only) --}}
{{-- Styles are in /css/main.css --}}

<nav class="bottom-nav">
    <div class="bottom-nav-container">
        {{-- Home --}}
        <a href="/" class="bottom-nav-item {{ Request::is('/') ? 'active' : '' }}">
            <svg class="bottom-nav-icon" viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span class="bottom-nav-label">Home</span>
        </a>

        {{-- Menu --}}
        <a href="/menu" class="bottom-nav-item {{ Request::is('menu') ? 'active' : '' }}">
            <svg class="bottom-nav-icon" viewBox="0 0 24 24">
                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path>
                <path d="M7 2v20"></path>
                <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"></path>
            </svg>
            <span class="bottom-nav-label">Menu</span>
        </a>

        {{-- Riwayat --}}
        <a href="/riwayat" class="bottom-nav-item {{ Request::is('riwayat') ? 'active' : '' }}">
            <svg class="bottom-nav-icon" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
            </svg>
            <span class="bottom-nav-label">Riwayat</span>
        </a>

        {{-- Kontak --}}
        <a href="/kontak" class="bottom-nav-item {{ Request::is('kontak') ? 'active' : '' }}">
            <svg class="bottom-nav-icon" viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <span class="bottom-nav-label">Kontak</span>
        </a>
    </div>
</nav>
