<div class="product-card">
    <div class="product-image-container">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
    </div>
    <div class="product-info">
        <h3 class="product-name">{{ $product->name }}</h3>
        @if(!empty($showDescription))
            <p class="product-description">{{ $product->description }}</p>
        @endif
        <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <div class="product-actions">
            <button type="button" class="btn-add-cart" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" @isset($buttonOnclick) onclick='{!! $buttonOnclick !!}' @endisset>
                <svg viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                {{ $buttonLabel ?? 'Masukkan ke keranjang' }}
            </button>
        </div>
    </div>
</div>
