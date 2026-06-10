{{-- Skeleton Loader Styles --}}
<style>
    /* Skeleton Animation */
    @keyframes skeleton-loading {
        0% {
            background-position: -200px 0;
        }
        100% {
            background-position: calc(200px + 100%) 0;
        }
    }

    .skeleton {
        background: linear-gradient(
            90deg,
            #f0f0f0 0px,
            #e0e0e0 40px,
            #f0f0f0 80px
        );
        background-size: 200px 100%;
        animation: skeleton-loading 1.5s infinite;
        border-radius: 8px;
    }

    /* Product Card Skeleton */
    .skeleton-card {
        background: linear-gradient(135deg, #d4b896 0%, #c9a882 100%);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .skeleton-image {
        width: 100%;
        height: 200px;
        background: white;
        border-radius: 15px;
        margin-bottom: 15px;
        position: relative;
        overflow: hidden;
    }

    .skeleton-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg,
            rgba(255, 255, 255, 0) 0px,
            rgba(255, 255, 255, 0.8) 50%,
            rgba(255, 255, 255, 0) 100px
        );
        animation: skeleton-loading 1.5s infinite;
    }

    .skeleton-text {
        height: 20px;
        margin-bottom: 10px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 4px;
    }

    .skeleton-text-short {
        width: 60%;
    }

    .skeleton-button {
        height: 40px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 25px;
        margin-top: 10px;
    }

    /* Hide skeleton when content loads */
    .skeleton-container.loaded {
        display: none;
    }

    /* Page Loader */
    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(245, 222, 179, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 0.3s, visibility 0.3s;
    }

    .page-loader.hidden {
        opacity: 0;
        visibility: hidden;
    }

    .loader-spinner {
        width: 60px;
        height: 60px;
        border: 4px solid #d4b896;
        border-top-color: #8b7355;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .loader-text {
        margin-top: 20px;
        color: #8b7355;
        font-weight: 600;
        font-size: 16px;
    }

    /* Button Loading State */
    .btn-loading {
        position: relative;
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
        border: 2px solid #ffffff;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    .btn-loading .btn-text {
        visibility: hidden;
    }

    /* Cart Badge Pulse Animation */
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    .cart-badge.pulse {
        animation: pulse 0.5s ease-in-out;
    }

    /* Success Checkmark Animation */
    @keyframes checkmark {
        0% {
            transform: scale(0) rotate(45deg);
        }
        50% {
            transform: scale(1.2) rotate(45deg);
        }
        100% {
            transform: scale(1) rotate(45deg);
        }
    }

    .success-checkmark {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        background: #4caf50;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: checkmark 0.5s ease-out;
    }

    .success-checkmark::before {
        content: '✓';
        color: white;
        font-size: 14px;
        font-weight: bold;
    }
</style>

{{-- Skeleton Card Template --}}
<div class="skeleton-card">
    <div class="skeleton-image"></div>
    <div class="skeleton-text"></div>
    <div class="skeleton-text skeleton-text-short"></div>
    <div class="skeleton-button"></div>
</div>

{{-- Page Loader Template --}}
<div class="page-loader" id="pageLoader">
    <div style="text-align: center;">
        <div class="loader-spinner"></div>
        <div class="loader-text">Memuat...</div>
    </div>
</div>
