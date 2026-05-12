# Setup Database MySQL - Toko Kue Kharisma

## Langkah-langkah Setup:

### 1. Buat Database di MySQL
Buka MySQL (via phpMyAdmin, MySQL Workbench, atau command line):

```sql
CREATE DATABASE toko_kue_kharisma;
```

### 2. Update File .env
File `.env` sudah diupdate dengan konfigurasi:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toko_kue_kharisma
DB_USERNAME=root
DB_PASSWORD=
```

**Catatan:** Jika MySQL kamu pakai password, isi `DB_PASSWORD=password_kamu`

### 3. Jalankan Migrations
Buka terminal di folder project, jalankan:

```bash
php artisan migrate
```

Ini akan membuat tabel:
- users
- products
- orders
- order_items
- reviews
- cache, jobs, sessions (Laravel default)

### 4. Jalankan Seeders (Isi Data Dummy)
```bash
php artisan db:seed
```

Ini akan mengisi database dengan:
- **1 Admin:** email: `admin1.admin@gmail.com`, password: `admin123`
- **3 Users:** Ghina, Budi, Siti (password: `password123`)
- **12 Produk:** Kue Pepe, Putri Ayu, Dadar Gulung, dll
- **5 Reviews:** Review dari customer

### 5. Test Login
- **Admin:** `admin1.admin@gmail.com` / `admin123` → redirect ke `/admin`
- **User:** `ghina@email.com` / `password123` → redirect ke `/profile`

## Troubleshooting:

### Error: "Access denied for user 'root'@'localhost'"
- Pastikan MySQL service sudah running
- Cek username dan password di `.env`

### Error: "Database doesn't exist"
- Pastikan sudah buat database `toko_kue_kharisma`

### Error: "SQLSTATE[HY000] [2002]"
- Pastikan MySQL service running
- Cek `DB_HOST` dan `DB_PORT` di `.env`

### Reset Database (Hapus semua data dan mulai dari awal)
```bash
php artisan migrate:fresh --seed
```

## Struktur Database:

### Tabel: users
- id, name, email, password, email_verified_at, timestamps

### Tabel: products
- id, name, description, price, stock, category, image_url, timestamps

### Tabel: orders
- id, order_number, user_id, subtotal, shipping_cost, discount, total, payment_method, status, timestamps

### Tabel: order_items
- id, order_id, product_id, quantity, price, subtotal, timestamps

### Tabel: reviews
- id, name, rating, review, timestamps

## Fitur yang Sudah Connect ke Database:

✅ Login/Register dengan validasi database
✅ Admin login (email: admin1.admin@gmail.com)
✅ User profile dari database
✅ Data produk dari database (siap digunakan)
✅ Reviews dari database (siap digunakan)

## Next Steps (Opsional):

Untuk menampilkan data dari database di halaman:
1. Update HomeController untuk fetch products dari database
2. Update ReviewController untuk fetch reviews dari database
3. Implement cart system dengan database
4. Implement order system dengan database
