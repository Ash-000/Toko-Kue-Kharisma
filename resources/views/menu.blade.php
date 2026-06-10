<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu - Toko Kue Kharisma</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    @include('partials.font-styles')
    <style>
        /* Menu Section */
        .menu-section {
            padding: 50px;
            padding-top: 120px;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .menu-header { text-align: center; margin-bottom: 40px; }
        .menu-title {
            font-size: 38px; position: relative; display: inline-block; padding-bottom: 12px;
            color: var(--color-brown); font-weight: 700;
        }
        .menu-title::after {
            content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);
            width: 60px; height: 4px; border-radius: 2px;
            background: linear-gradient(90deg, var(--color-accent), var(--color-accent-soft));
        }
        .menu-subtitle { margin-top: 15px; font-style: italic; opacity: 0.8; color: var(--color-brown); }

        /* Category Filter */
        .category-filter { display: flex; justify-content: center; gap: 12px; margin-bottom: 40px; flex-wrap: wrap; }
        .category-btn {
            background: var(--color-white); border: 2px solid rgba(212, 184, 150, 0.3);
            padding: 10px 24px; border-radius: 50px; font-size: 14px; font-weight: 700;
            color: var(--color-brown); cursor: pointer; transition: all 0.3s;
        }
        .category-btn:hover {
            border-color: var(--color-accent-soft); color: var(--color-accent);
            box-shadow: 0 4px 12px rgba(224,123,57,0.1);
        }
        .category-btn.active {
            background: linear-gradient(135deg, var(--color-accent), var(--color-accent-soft));
            color: white; border-color: transparent;
            box-shadow: 0 4px 12px rgba(224,123,57,0.2);
        }

        /* Controls & Search */
        .table-controls { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 15px; margin-bottom: 25px; align-items: center; }
        .search-wrapper { position: relative; width: 100%; max-width: 420px; }
        .search-wrapper svg {
            position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
            width: 20px; height: 20px; stroke: var(--color-text-light); fill: none; stroke-width: 2;
        }
        .search-input {
            width: 100%; padding: 14px 16px 14px 48px; border-radius: 50px;
            border: 2px solid rgba(212, 184, 150, 0.3); font-size: 15px; outline: none;
            transition: all 0.3s ease; background: var(--color-white);
        }
        .search-input:focus {
            border-color: var(--color-accent);
            box-shadow: 0 0 0 4px rgba(224, 123, 57, 0.1);
        }
        .search-input:focus + svg, .search-wrapper:focus-within svg { stroke: var(--color-accent); }
        .pagination-info { color: var(--color-text-mid); font-weight: 700; font-size: 14px; }

        /* Pagination Buttons */
        .pagination-buttons { display: flex; gap: 12px; margin-top: 30px; justify-content: center; }
        .pagination-buttons button {
            background: linear-gradient(135deg, var(--color-accent), var(--color-accent-soft));
            color: white; border: none; border-radius: 50px; padding: 12px 28px;
            cursor: pointer; font-weight: 700; transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(224,123,57,0.15);
        }
        .pagination-buttons button:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: var(--shadow-accent);
        }
        .pagination-buttons button:disabled { background: #e0e0e0; cursor: not-allowed; opacity: 0.5; box-shadow: none; }

        /* Modal Detail Produk */
        .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); backdrop-filter: blur(5px); align-items: center; justify-content: center; }
        .modal-content { background: var(--color-bg-alt); padding: 30px; border-radius: 20px; width: 95%; max-width: 750px; position: relative; box-shadow: var(--shadow-lg); display: flex; flex-direction: column; gap: 20px; animation: zoomIn 0.3s ease; }
        @keyframes zoomIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
        .close-modal { position: absolute; right: 20px; top: 15px; font-size: 30px; cursor: pointer; color: var(--color-brown); }
        .modal-body { display: flex; gap: 20px; }
        .modal-img { width: 300px; height: 300px; object-fit: cover; border-radius: 15px; flex-shrink: 0; }
        .product-description-text { color: var(--color-text-mid); line-height: 1.6; text-align: justify; margin-bottom: 20px; min-height: 4.8em; max-height: 6.4em; overflow: hidden; }
        .modal-footer-actions { display: flex; flex-direction: row; gap: 15px; align-items: center; border-top: 1px solid rgba(139, 115, 85, 0.1); padding-top: 20px; }

        @media (max-width: 600px) {
            .modal-body { flex-direction: column; }
            .modal-img { width: 100%; height: auto; }
            .menu-section { padding: 30px 20px; padding-top: 100px; }
            .menu-title { font-size: 28px; }
            .search-input { max-width: 100%; }
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .product-card { animation: fadeInUp 0.6s ease backwards; }
        .product-card:nth-child(1) { animation-delay: 0.1s; }
        .product-card:nth-child(2) { animation-delay: 0.2s; }
        .product-card:nth-child(3) { animation-delay: 0.3s; }
        .product-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
    @include('partials.notif-styles')
    @include('partials.auto-hide-navbar')
    @include('partials.enhanced-interactions')
</head>
<body style="overflow-x: hidden !important; max-width: 100vw !important; margin: 0 !important;">
    @include('partials.header')

    <!-- Menu Section -->
    <section class="menu-section">
        <div class="menu-header">
            <h1 class="menu-title">Menu Kue Kami</h1>
            <p class="menu-subtitle">Pilih kue tradisional favorit Anda</p>
        </div>

        <div class="table-controls">
            <div class="search-wrapper">
                <input type="text" id="productSearch" class="search-input" placeholder="Cari kue favorit Anda..." autocomplete="off">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            </div>
            <div class="pagination-info" id="paginationInfo">Menampilkan 0 produk</div>
        </div>

        <div class="products-grid" id="productsGrid"></div>

        <div class="pagination-buttons">
            <button id="prevPage" onclick="changePage(-1)" disabled>Prev</button>
            <button id="nextPage" onclick="changePage(1)" disabled>Next</button>
        </div>
    </section>

    {{-- Bottom Navigation (Mobile) --}}
    @include('partials.bottom-nav')

    <script>
        let cartCount = 0;

        // Hamburger Menu Toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        // Ensure menu is closed on page load
        document.addEventListener('DOMContentLoaded', function() {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
        });

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

        // Add to Cart with Enhanced Loading State
        function addToCart(btn, productId, itemName, price) {
            // Prevent double-click
            if (btn.classList.contains('btn-loading')) return;
            
            // Pastikan productId adalah integer
            const id = parseInt(productId);
            if (isNaN(id)) {
                console.error('Invalid product ID:', productId);
                showNotification('ID produk tidak valid', 'error');
                return;
            }

            // Add loading state
            btn.classList.add('btn-loading');
            const originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="btn-text">Menambahkan...</span>';

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // AJAX request to add to cart
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: id,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart badge with pulse animation
                    const badge = document.getElementById('cartBadge');
                    if (badge) {
                        badge.textContent = data.data.total_items;
                        badge.classList.add('pulse');
                        setTimeout(() => badge.classList.remove('pulse'), 500);
                    }

                    // Show success state
                    btn.innerHTML = '<span class="success-checkmark"></span><span class="btn-text">Ditambahkan!</span>';
                    btn.style.background = '#4caf50';
                    
                    // Reset after 2 seconds
                    setTimeout(() => {
                        btn.innerHTML = originalHTML;
                        btn.style.background = '';
                        btn.classList.remove('btn-loading');
                        btn.disabled = false;
                    }, 2000);

                    showNotification(`${itemName} berhasil ditambahkan ke keranjang!`, 'success');
                } else {
                    // Show error notification
                    btn.classList.remove('btn-loading');
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                    showNotification(data.message || 'Gagal menambahkan ke keranjang', 'error');
                }
            })
            .catch(error => {
                btn.classList.remove('btn-loading');
                btn.innerHTML = originalHTML;
                btn.disabled = false;
                showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
            });
        }

        // Notification System
        function showNotification(message, type = 'success') {
            const colors = {
                success: '#4caf50',
                error: '#f44336',
                warning: '#ff9800',
                info: '#2196f3'
            };

            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 30px;
                background: ${colors[type]};
                color: white;
                padding: 15px 25px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                z-index: 10000;
                animation: slideIn 0.3s ease-out;
                font-weight: 600;
                max-width: 400px;
            `;

            const icon = type === 'success' ? '✔' : type === 'error' ? '✖' : 'i';
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 18px;">${icon}</span>
                    <span>${message}</span>
                </div>
            `;

            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideIn {
                    from { transform: translateX(400px); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slideOut {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(400px); opacity: 0; }
                }
            `;
            document.head.appendChild(style);

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // View Cart
        function viewCart() {
            window.location.href = '/cart';
        }

        const menuProducts = {!! json_encode($products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category' => $product->category,
                'image_url' => $product->image_url,
            ];
        })->toArray()) !!};
        let currentPage = 1;
        const perPage = 8;
        let filteredProducts = [...menuProducts];

        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
        }

        function renderGrid() {
            const grid = document.getElementById('productsGrid');
            grid.innerHTML = '';

            const start = (currentPage - 1) * perPage;
            const pageItems = filteredProducts.slice(start, start + perPage);

            if (pageItems.length === 0) {
                grid.innerHTML = '<p style="text-align:center;color:#7a6c5b;padding:40px;grid-column:1/-1;">Tidak ada produk ditemukan.</p>';
            } else {
                pageItems.forEach(product => {
const card = document.createElement('div');
card.className = 'product-card';
card.innerHTML = `
    <div class="product-image-container" onclick="showDetail(${product.id})" style="cursor:pointer;">
        <img src="${product.image_url ?? '/images/products/default.jpg'}" alt="${product.name}" class="product-image" loading="lazy">
    </div>
    <div class="product-info">
        <h3 class="product-name" onclick="showDetail(${product.id})" style="cursor:pointer;">${product.name}</h3>
        <p class="product-price">Rp ${Number(product.price).toLocaleString('id-ID')}</p>
        <div class="product-actions">
            <button class="btn-add-cart">
                <svg viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                Masukkan ke keranjang
            </button>
        </div>
    </div>
`;

                    const button = card.querySelector('.btn-add-cart');
                    button.addEventListener('click', function() {
                        addToCart(this, product.id, product.name, product.price);
                    });

                    grid.appendChild(card);
                });
            }

            const pageCount = Math.max(1, Math.ceil(filteredProducts.length / perPage));
            document.getElementById('paginationInfo').textContent = `Halaman ${currentPage} dari ${pageCount} · ${filteredProducts.length} produk`;
            document.getElementById('prevPage').disabled = currentPage <= 1;
            document.getElementById('nextPage').disabled = currentPage >= pageCount;
        }

        function changePage(direction) {
            const pageCount = Math.max(1, Math.ceil(filteredProducts.length / perPage));
            currentPage = Math.min(pageCount, Math.max(1, currentPage + direction));
            renderGrid();
        }

        function filterProducts() {
            const searchValue = document.getElementById('productSearch').value.trim().toLowerCase();
            filteredProducts = menuProducts.filter(product => {
                const searchData = `${product.name} ${product.description || ''} ${product.price}`.toLowerCase();
                return searchData.includes(searchValue);
            });
            currentPage = 1;
            renderGrid();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Hide page loader
            const pageLoader = document.getElementById('pageLoader');
            if (pageLoader) {
                setTimeout(() => {
                    pageLoader.classList.add('hidden');
                }, 300);
            }
            
            document.getElementById('productSearch').addEventListener('input', filterProducts);
            renderGrid();
        });
                                            
function showDetail(productId) {
    const product = menuProducts.find(p => p.id === productId);
    if (!product) return;

    const modal = document.getElementById('productModal');
    const modalBody = document.getElementById('modalBody');

    const description = product.description || `${product.name} yang enak dan lezat.`;

    modalBody.innerHTML = `
        <img src="${product.image_url ?? '/images/products/default.jpg'}" class="modal-img">
        <div style="flex: 1; display: flex; flex-direction: column;">
            <h2 style="color: #2c2c2c; margin-bottom: 15px; font-size: 1.8rem;">${product.name}</h2>

            <p style="color: #8b7355; font-weight: bold; font-size: 1.6rem; margin-bottom: 20px;">
                Rp ${Number(product.price).toLocaleString('id-ID')}
            </p>

            <div style="flex-grow: 1;">
                <h4 style="color: #4a4a4a; margin-bottom: 8px;">Deskripsi Produk:</h4>
                <p style="color: #555; line-height: 1.7; text-align: justify; margin-bottom: 20px;">
                    ${description}
                </p>
            </div>

            <div class="modal-footer-actions" style="display: flex; flex-direction: row; gap: 15px; align-items: center; border-top: 1px solid rgba(139, 115, 85, 0.1); padding-top: 20px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <label style="color: #555; font-weight: 600; white-space: nowrap;">Jumlah:</label>
                    <input type="number" id="detailQty" value="1" min="1"
                        style="width: 70px; padding: 12px; border-radius: 12px; border: 1.5px solid #d4b896; text-align: center; background: white;">
                </div>
                <button class="btn-add-cart" style="flex: 1; padding: 15px; height: 50px;"
                    onclick="closeModal(); addToCart(this, ${product.id}, '${product.name}', ${product.price})">
                    Tambah ke Keranjang
                </button>
            </div>
        </div>
    `;

    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

// Tutup modal jika klik di luar kotak putih
window.onclick = function(event) {
    const modal = document.getElementById('productModal');
    if (event.target == modal) {
        closeModal();
    }
}
    </script>
                                            <div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <div class="modal-body" id="modalBody">
            </div>
    </div>
</div>
@include('partials.notif-scripts')
</body>
</html>
