# CARA UPLOAD GAMBAR PRODUK BERBEDA

## Masalah
Semua produk menampilkan gambar yang sama di halaman Home Best Sellers.

## Penyebab
- Field `image` di database produk kosong atau sama untuk semua produk
- Gambar belum di-upload melalui Filament Admin Panel

## Solusi

### 1. Upload Gambar Melalui Admin Panel

**Langkah:**
1. Login ke Admin Panel: `http://localhost/admin`
2. Masuk ke menu **Products**
3. Klik produk yang ingin di-edit
4. Scroll ke bagian **Image**
5. Upload gambar produk yang sesuai
6. Klik **Save**
7. Ulangi untuk semua produk

### 2. Upload Bulk via Database (Alternatif)

Jika ingin cepat, bisa update database langsung:

```sql
-- Update produk dengan gambar dari folder public/images/products
UPDATE products SET image = 'products/products/pie-buah.jpg' WHERE name = 'Pie Buah';
UPDATE products SET image = 'products/products/kue-lumpur.jpg' WHERE name = 'Kue Lumpur';
UPDATE products SET image = 'products/products/bolu-pelangi.jpg' WHERE name = 'Bolu Pelangi';
UPDATE products SET image = 'products/products/putu-ayu.jpg' WHERE name = 'Putu Ayu';
-- dst...
```

### 3. Verifikasi

**Cek di Home Page:**
- Hard refresh: `Ctrl + Shift + R`
- Lihat apakah gambar sudah berbeda untuk setiap produk
- Hover gambar untuk melihat tooltip: "Product ID: X | Total Ordered: Y"

### 4. Best Sellers Logic

**Produk yang muncul di Home Best Sellers:**
- 4 produk dengan pemesanan terbanyak (berdasarkan `total_ordered`)
- Exclude kategori "Paket Promo"
- Jika belum ada yang dipesan, tampilkan 4 produk pertama

**Badge Bestseller:**
- Muncul jika produk sudah pernah dipesan (total_ordered > 0)
- Format: "⭐ X Terjual"

### 5. Path Gambar yang Didukung

Code mendukung berbagai format path:
- `products/products/filename.jpg` (double path dari storage)
- `products/filename.jpg` (single path)
- `http://...` (URL lengkap)
- Jika kosong → fallback ke slug produk: `images/products/nama-produk.jpg`
- Jika error → fallback ke `images/products/bolu-pelangi.jpg`

### 6. Folder Gambar

**Storage (Upload via Admin):**
- `storage/app/public/products/products/`
- URL: `http://localhost/storage/products/products/filename.jpg`

**Public (Static):**
- `public/images/products/`
- URL: `http://localhost/images/products/filename.jpg`

## Testing

1. Upload gambar berbeda untuk 4-5 produk via admin
2. Hard refresh home page
3. Periksa apakah gambar sudah berbeda
4. Hover gambar untuk lihat Product ID dan Total Ordered
5. Pesan produk beberapa kali
6. Cek apakah badge "⭐ X Terjual" muncul

## Troubleshooting

**Gambar tidak muncul:**
- Periksa path di database: `SELECT id, name, image FROM products;`
- Periksa file exists: `storage/app/public/products/products/filename.jpg`
- Periksa console browser (F12) untuk error 404

**Semua produk masih sama:**
- Kemungkinan field `image` di database kosong atau sama
- Upload gambar baru via admin untuk setiap produk

**Badge tidak muncul:**
- Belum ada order untuk produk tersebut
- Pesan produk minimal 1x agar badge muncul
