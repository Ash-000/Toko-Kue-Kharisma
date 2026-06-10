<style>
/* ================================
   ENHANCED UX INTERACTIONS
   Membuat website lebih hidup dan engaging
   ================================ */

/* 1. PROFESSIONAL CURSOR - Subtle interaction */
body {
    cursor: default;
}

a, button, .clickable {
    cursor: pointer !important;
}

/* 2. CLEAN CARD DESIGN - Professional rounded corners */
.product-card,
.info-card,
.review-card,
.order-card {
    border-radius: 16px !important;
    position: relative;
    overflow: visible !important;
}

.product-card::before {
    display: none; /* Remove glowing border effect */
}

/* 3. PLAYFUL BUTTON STATES - Removed emoji */
.btn-add-cart,
.btn-submit,
.btn-checkout {
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55) !important;
}

.btn-add-cart:hover {
    transform: scale(1.05) !important;
    box-shadow: 0 8px 20px rgba(139, 115, 85, 0.4) !important;
}

.btn-add-cart:active {
    transform: scale(0.95) !important;
    animation: buttonPulse 0.3s ease;
}

@keyframes buttonPulse {
    0%, 100% { transform: scale(0.95); }
    50% { transform: scale(1.05); }
}

/* 4. PROFESSIONAL BADGE ANIMATION - Subtle pulse */
.cart-badge,
.notif-badge {
    animation: subtlePulse 2s ease-in-out infinite;
}

@keyframes subtlePulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.cart-badge:hover,
.notif-badge:hover {
    transform: scale(1.1);
    transition: transform 0.2s ease;
}

/* 5. TEXTURED BACKGROUND - Organic feel */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(212, 184, 150, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(201, 168, 130, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(139, 115, 85, 0.05) 0%, transparent 50%);
    pointer-events: none;
    z-index: -1;
}

/* FIX: Keep header fixed, only reset z-index for other elements */
body > nav,
body > section,
body > footer,
body > .menu-overlay {
    position: relative;
    z-index: auto;
}

/* 6. SMOOTH SCROLL SNAP - Better UX */
html {
    scroll-behavior: smooth;
}

/* 7. PROFESSIONAL SHADOWS - Clean elevation */
.product-card,
.cart-summary,
.checkout-modal-content,
.info-card {
    box-shadow: 
        0 2px 8px rgba(0,0,0,0.08),
        0 4px 16px rgba(0,0,0,0.06) !important;
}

.product-card:hover {
    box-shadow: 
        0 4px 12px rgba(0,0,0,0.10),
        0 8px 24px rgba(0,0,0,0.08) !important;
}

/* 8. HOVER EFFECTS - Removed emoji */
.product-card:hover .product-image-container::after {
    display: none; /* Remove emoji on hover */
}

/* 9. LOADING SKELETON SHIMMER - Better loading state */
@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

.skeleton {
    background: linear-gradient(
        90deg,
        #f0f0f0 25%,
        #e0e0e0 50%,
        #f0f0f0 75%
    );
    background-size: 1000px 100%;
    animation: shimmer 2s infinite linear;
    border-radius: 15px;
}

/* 10. HEADER ICONS BOUNCE ON NOTIFICATION */
@keyframes iconBounce {
    0%, 100% { transform: translateY(0) scale(1); }
    25% { transform: translateY(-8px) scale(1.1); }
    50% { transform: translateY(0) scale(1); }
    75% { transform: translateY(-4px) scale(1.05); }
}

.icon-wrapper.has-notification .icon-btn {
    animation: iconBounce 0.6s ease;
}

/* 11. SMOOTH IMAGE REVEAL */
.product-image,
.hero-image {
    animation: imageReveal 0.6s ease-out;
}

@keyframes imageReveal {
    0% {
        opacity: 0;
        transform: scale(1.1);
        filter: blur(10px);
    }
    100% {
        opacity: 1;
        transform: scale(1);
        filter: blur(0);
    }
}

/* 12. PROFESSIONAL PRICE TAG - Enhanced hover */
.product-card:hover .product-price {
    transform: scale(1.05);
    box-shadow: 0 2px 8px rgba(224, 123, 57, 0.15);
}

/* 13. TEXT HIGHLIGHT ANIMATION */
::selection {
    background-color: #d4b896;
    color: #2c2c2c;
}

::-moz-selection {
    background-color: #d4b896;
    color: #2c2c2c;
}

/* 14. CLEAN FOOTER DESIGN - Removed wave effect */
footer {
    position: relative;
}

/* 15. SMOOTH FOCUS STATES */
input:focus,
textarea:focus,
select:focus,
.form-control:focus {
    outline: none !important;
    border-color: #8b7355 !important;
    box-shadow: 
        0 0 0 3px rgba(139, 115, 85, 0.1),
        0 4px 12px rgba(139, 115, 85, 0.15) !important;
    transform: translateY(-1px);
}

/* 16. STAGGERED FADE-IN FOR LISTS */
.review-card,
.order-card {
    animation: fadeInUp 0.6s ease-out backwards;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* 17. PROFESSIONAL NAV ANIMATION */
nav a {
    transition: all 0.2s ease !important;
}

nav a:hover {
    transform: translateY(-2px) !important;
    text-shadow: none;
}

/* 18. CART ICON SHAKE ON ADD */
@keyframes cartShake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px) rotate(-5deg); }
    75% { transform: translateX(5px) rotate(5deg); }
}

.icon-wrapper.cart-updated .icon-btn {
    animation: cartShake 0.5s ease;
}

/* 19. MOBILE: SMOOTH MENU SLIDE */
@media (max-width: 768px) {
    nav a {
        animation: slideInRight 0.4s ease-out backwards;
    }
    
    nav a:nth-child(1) { animation-delay: 0.1s; }
    nav a:nth-child(2) { animation-delay: 0.15s; }
    nav a:nth-child(3) { animation-delay: 0.2s; }
    nav a:nth-child(4) { animation-delay: 0.25s; }
    
    @keyframes slideInRight {
        0% {
            opacity: 0;
            transform: translateX(50px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }
}

/* 20. SUCCESS STATE ANIMATIONS */
.btn-success-state {
    background: #4caf50 !important;
    animation: successPulse 0.6s ease;
}

@keyframes successPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); box-shadow: 0 0 20px rgba(76, 175, 80, 0.6); }
}

/* 21. PARALLAX SCROLL EFFECT */
.hero,
.about-section {
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

/* 22. GLASSMORPHISM EFFECT */
.checkout-modal-content,
.review-modal .modal-content,
.notif-dropdown {
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    background-color: rgba(255, 255, 255, 0.95) !important;
    border: 1px solid rgba(209, 213, 219, 0.3);
}

/* 23. BREATH ANIMATION FOR BADGES - Subtle professional animation */
.cart-badge,
.notif-badge {
    animation: breathe 3s ease-in-out infinite !important;
}

@keyframes breathe {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.08); }
}

/* 25. TOOLTIP ENHANCEMENT */
[data-tooltip] {
    position: relative;
}

[data-tooltip]::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%) translateY(-8px);
    background: rgba(44, 44, 44, 0.9);
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s, transform 0.3s;
    backdrop-filter: blur(10px);
}

[data-tooltip]:hover::after {
    opacity: 1;
    transform: translateX(-50%) translateY(-12px);
}
</style>

<script>
// Enhanced Interactions Script
document.addEventListener('DOMContentLoaded', function() {
    console.log('Enhanced interactions loaded');
    
    // 1. Cart Shake Animation on Add
    const originalFetch = window.fetch;
    window.fetch = function(...args) {
        return originalFetch.apply(this, args).then(response => {
            if (args[0].includes('/cart/add')) {
                const cartIcon = document.querySelector('.icon-wrapper:has(.cart-badge)');
                if (cartIcon) {
                    cartIcon.classList.add('cart-updated');
                    setTimeout(() => cartIcon.classList.remove('cart-updated'), 500);
                }
            }
            return response;
        });
    };
    
    // 2. Notification Badge Bounce
    function animateNotificationBadge() {
        const notifWrapper = document.querySelector('.icon-wrapper:has(.notif-badge)');
        if (notifWrapper) {
            notifWrapper.classList.add('has-notification');
            setTimeout(() => notifWrapper.classList.remove('has-notification'), 600);
        }
    }
    
    // 3. Professional Click Handler - Removed confetti easter egg
    // Easter egg removed for professional appearance
    
    // 4. Smooth scroll to section
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // 5. Image Lazy Load with Fade
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
    
    // 6. Add Tooltips to Icons
    const cartIcon = document.querySelector('[title="Keranjang"]');
    const profileIcon = document.querySelector('[title="Profil"]');
    const notifIcon = document.querySelector('[title="Notifikasi"]');
    
    if (cartIcon) cartIcon.parentElement.setAttribute('data-tooltip', 'Keranjang Belanja');
    if (profileIcon) profileIcon.parentElement.setAttribute('data-tooltip', 'Profil Saya');
    if (notifIcon) notifIcon.parentElement.setAttribute('data-tooltip', 'Notifikasi');
    
    // 7. Scroll Reveal Animation
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length > 0 && 'IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        revealElements.forEach(el => revealObserver.observe(el));
    }
    
    console.log('All enhanced interactions ready');
});
</script>
