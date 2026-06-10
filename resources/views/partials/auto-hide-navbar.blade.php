<style>
    /* Auto-hide Navbar Styles */
    header {
        transition: transform 0.3s ease-in-out !important;
        transform: translateY(0);
        top: 0;
    }

    header.navbar-hidden {
        transform: translateY(-100%) !important;
    }

    header.navbar-visible {
        transform: translateY(0) !important;
    }

    /* Add padding to body to compensate for fixed header */
    body {
        padding-top: 60px !important;
        margin: 0 !important;
    }

    /* Ensure content is not hidden behind navbar */
    .hero, .menu-section, .contact-container, .profile-container, .riwayat-container, .cart-container {
        margin-top: 0 !important;
    }

    /* Ensure footer is visible at bottom */
    footer {
        margin-bottom: 0 !important;
        position: relative !important;
        z-index: 1 !important;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        body {
            padding-top: 56px !important;
            padding-bottom: 75px !important;
            margin: 0 !important;
        }
    }

    @media (max-width: 480px) {
        body {
            padding-top: 52px !important;
            padding-bottom: 75px !important;
            margin: 0 !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('header');
        if (!header) {
            console.error('Header not found for auto-hide functionality');
            return;
        }

        console.log('Auto-hide navbar script loaded');

        let lastScrollTop = 0;
        let scrollThreshold = 5;
        let ticking = false;

        // Set initial state - ensure navbar is flush at top
        header.classList.add('navbar-visible');
        header.style.transform = 'translateY(0)';
        console.log('Navbar initialized as visible');

        function handleScroll() {
            const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Debug log
            // console.log('Scroll position:', currentScrollTop, 'Last:', lastScrollTop);
            
            // Jika di bagian paling atas, selalu tampilkan navbar
            if (currentScrollTop <= 5) {
                if (header.classList.contains('navbar-hidden') || !header.classList.contains('navbar-visible')) {
                    header.classList.remove('navbar-hidden');
                    header.classList.add('navbar-visible');
                }
                lastScrollTop = 0;
                return;
            }

            // Hitung perbedaan scroll
            const scrollDifference = Math.abs(currentScrollTop - lastScrollTop);
            
            // Hanya proses jika scroll cukup jauh
            if (scrollDifference < scrollThreshold) {
                return;
            }

            // Scroll ke bawah - sembunyikan navbar
            if (currentScrollTop > lastScrollTop && currentScrollTop > 100) {
                if (!header.classList.contains('navbar-hidden')) {
                    console.log('Scrolling down - hiding navbar');
                    header.classList.add('navbar-hidden');
                    header.classList.remove('navbar-visible');
                }
            } 
            // Scroll ke atas - tampilkan navbar
            else if (currentScrollTop < lastScrollTop) {
                if (header.classList.contains('navbar-hidden')) {
                    console.log('Scrolling up - showing navbar');
                    header.classList.remove('navbar-hidden');
                    header.classList.add('navbar-visible');
                }
            }

            lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
        }

        // Request animation frame for smoother performance
        function requestTick() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        }

        // Add scroll event listener with passive for better performance
        window.addEventListener('scroll', requestTick, { passive: true });
        console.log('Scroll listener attached');

        // Handle mobile menu - jangan sembunyikan navbar saat menu terbuka
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const menuOverlay = document.getElementById('menuOverlay');
        
        if (hamburger && navMenu) {
            hamburger.addEventListener('click', function() {
                const willBeActive = !navMenu.classList.contains('active');
                if (willBeActive) {
                    header.classList.remove('navbar-hidden');
                    header.classList.add('navbar-visible');
                    console.log('Mobile menu opened - showing navbar');
                }
            });
            console.log('Mobile menu handler attached');
        }

        // Jika overlay diklik (menu ditutup)
        if (menuOverlay) {
            menuOverlay.addEventListener('click', function() {
                setTimeout(handleScroll, 300);
                console.log('Menu overlay clicked - re-evaluating navbar');
            });
        }

        console.log('Auto-hide navbar fully initialized');
    });
</script>
