# Toko Kue Kharisma 🍰

Aplikasi pemesanan kue online berbasis Laravel untuk Toko Kue Kharisma, Dramaga - Bogor Barat.

## Fitur

- Katalog produk & menu kue tradisional
- Keranjang belanja
- Checkout dengan 3 metode pembayaran: **QRIS (Midtrans)**, **Transfer Bank**, **COD**
- Upload bukti transfer & verifikasi admin
- Riwayat pesanan & notifikasi real-time
- Halaman promo & paket hemat
- Panel admin (Filament) untuk kelola produk, pesanan, ulasan, dan user
- Profil user dengan peta lokasi pengiriman (OpenStreetMap)

## Teknologi

- **Backend:** Laravel 12, PHP 8.2
- **Admin Panel:** Filament 3
- **Payment Gateway:** Midtrans (QRIS & Snap)
- **Frontend:** Blade, Vanilla JS
- **Database:** MySQL
- **Maps:** Leaflet.js + OpenStreetMap

## Cara Setup

### 1. Clone & Install

```bash
git clone https://github.com/Ash-000/Toko-Kue-Kharisma.git
cd Toko-Kue-Kharisma
composer install
npm install
```

### 2. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` dan isi:
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `MIDTRANS_MERCHANT_ID`, `MIDTRANS_CLIENT_KEY`, `MIDTRANS_SERVER_KEY`

### 3. Database & Storage

```bash
php artisan migrate --seed
php artisan storage:link
```

### 4. Build & Jalankan

```bash
npm run build
php artisan serve
```

Akses di: `http://localhost:8000`

## Akun Default (Seeder)

| Role  | Email              | Password |
|-------|--------------------|----------|
| Admin | admin@kharisma.com | 12345678 |
| User  | user@example.com   | password123 |

> ⚠️ Ganti password sebelum deploy ke production.

## Midtrans

Aplikasi ini menggunakan **Midtrans Sandbox** secara default (`MIDTRANS_IS_PRODUCTION=false`).  
Untuk production, set `MIDTRANS_IS_PRODUCTION=true` dan gunakan key production dari dashboard Midtrans.

Webhook URL yang perlu didaftarkan di Midtrans:
```
https://yourdomain.com/midtrans/notification
```

## Struktur Folder Penting

```
app/
├── Filament/          # Admin panel resources & widgets
├── Http/Controllers/  # Semua controller
├── Models/            # Eloquent models
resources/views/       # Blade templates
routes/web.php         # Semua route
database/
├── migrations/        # Skema database
└── seeders/           # Data awal
```
