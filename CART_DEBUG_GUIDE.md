# Debug Guide - Add to Cart Issue

Jika produk tidak masuk ke keranjang, ikuti langkah-langkah berikut:

## 1. Buka Browser Console
- **Chrome/Firefox/Edge**: Tekan `F12` atau `Ctrl+Shift+I` (Windows) / `Cmd+Option+I` (Mac)
- Pilih tab **Console**

## 2. Cek Status Login
- Pastikan Anda sudah login
- Jika belum login, sistem akan menampilkan pesan "Silakan login terlebih dahulu"

## 3. Coba Tambah Produk ke Keranjang
- Klik tombol "Masukkan ke keranjang" atau "Keranjang" di halaman home/menu
- **Perhatikan console** untuk melihat log:
  - `Adding to cart: { productId: X, productName: "...", csrfToken: "..." }`
  - `Response status: 200` (jika berhasil) atau `401` (jika perlu login)
  - `Response data: { success: true, ... }` (jika berhasil)

## 4. Pesan Error Umum
| Error | Penyebab | Solusi |
|-------|---------|--------|
| `Response status: 401` | Belum login | Login dahulu |
| `Response status: 422` | Validasi gagal (product_id tidak valid, CSRF token hilang) | Reload halaman, periksa token |
| `Response status: 404` | Produk tidak ditemukan di database | Periksa apakah produk ada di database |
| `Invalid product ID` | Product ID tidak valid | Reload halaman |

## 5. Periksa Elemen Penting
Di tab **Elements/Inspector**, cari:
- `<meta name="csrf-token" content="...">` - Token CSRF harus ada
- `<span class="cart-badge" id="cartBadge">0</span>` - Badge keranjang harus ada

## 6. Test Endpoint Secara Manual (Advanced)
Di Console, jalankan:
```javascript
fetch('/api/cart/count').then(r => r.json()).then(d => console.log(d))
```

Jika response berupa `{ count: X }`, endpoint berfungsi dengan baik.

## 7. Database Check
Jika semua kelihatan baik tapi produk tidak muncul di keranjang, cek database:
```sql
-- Lihat cart items untuk user (ganti ID_USER)
SELECT * FROM carts WHERE user_id = ID_USER;
```

---

**Jika masalah masih berlanjut, lihat console log lengkap dan bagikan output ke developer.**
