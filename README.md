# Toko Kue Kharisma - Platform E-Commerce

Platform e-commerce modern untuk penjualan kue online dengan fitur keranjang belanja real-time, riwayat pemesanan, dan sistem pembayaran terintegrasi.

## 🎯 Fitur Utama

- **Katalog Produk** - Daftar kue dengan pencarian dan filter kategori
- **Keranjang Belanja** - Tambah/ubah/hapus produk dengan badge pembaruan real-time
- **Sistem Checkout** - Metode pembayaran QRIS dan COD
- **Riwayat Pemesanan** - Tracking pesanan dengan status real-time (pending → verified → in_progress → completed)
- **User Profile** - Kelola data pribadi dan alamat pengiriman
- **Sistem Review** - Tambahkan rating dan ulasan produk (1-5 bintang)
- **Responsive Design** - Kompatibel dengan mobile dan desktop
- **Admin Panel** - Verifikasi pesanan dan kelola status

## 🛠️ Tech Stack

- **Backend**: Laravel 10+
- **Frontend**: HTML5, CSS3, Vanilla JavaScript (ES6+)
- **Database**: MySQL 8.0+
- **Cache**: Redis
- **Authentication**: Laravel Auth Session
- **Assets**: Vite, npm

## 📚 Quick Start

### Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js 18+

### Installation

1. **Clone repository**
   ```bash
   git clone <your-repo-url>
   cd tokokue
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** (edit `.env`)
   ```ini
   DB_CONNECTION=mysql
   DB_DATABASE=toko_kue_kharisma
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations and seeds**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Build frontend assets**
   ```bash
   npm run dev
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

Akses aplikasi di `http://localhost:8000`

## 📁 Project Structure

```
tokokue/
├── app/
│   ├── Http/Controllers/          # Controllers
│   ├── Models/                    # Eloquent Models
│   └── Providers/
├── config/                        # Configuration files
├── database/
│   ├── migrations/                # Database schema
│   └── seeders/
├── public/                        # Static assets
├── resources/
│   ├── css/                       # Stylesheets
│   ├── js/                        # JavaScript
│   └── views/                     # Blade templates
├── routes/                        # Route definitions
└── storage/                       # Logs & uploads
```

## 🔑 Key Components

### Models
- **User** - User account & profile data
- **Product** - Product catalog
- **Cart** - Shopping cart items per user
- **Order** - Customer orders with status tracking
- **OrderItem** - Individual items in orders
- **Review** - Product reviews with ratings

### Controllers
- **HomeController** - Homepage product display
- **ProductController** - Product listing & filtering
- **CartController** - Cart operations (add/update/remove)
- **OrderController** - Order history & tracking
- **AuthController** - Authentication
- **AdminController** - Order verification & management

### API Endpoints
- `GET /api/cart/count` - Get cart item count
- `POST /cart/add` - Add product to cart
- `POST /cart/update` - Update cart quantity
- `POST /cart/remove` - Remove from cart
- `GET /api/orders/history` - Get order history (real-time polling)

## 📖 Documentation

- **[DATABASE_SETUP.md](DATABASE_SETUP.md)** - Database schema & relationships
- **[PRODUCTION_README.md](PRODUCTION_README.md)** - Production deployment checklist

## 🚀 Features in Detail

### Shopping Flow
1. Browse products on `/menu` (searchable table with pagination)
2. Add items to cart (auto qty=1 per click)
3. View cart at `/cart` with quantities
4. Checkout with payment method selection
5. View order history in `/riwayat` with status tracking

### Admin Features
- Verify pending orders
- Update order status through timeline
- Track payment confirmations

### Real-Time Updates
- Cart badge updates across all pages
- Order history refreshes every 5 seconds
- Payment status tracking

## ⚙️ Configuration

### Environment Variables (`.env`)
```ini
APP_NAME=Toko Kue Kharisma
APP_ENV=local
APP_DEBUG=true
DB_DATABASE=toko_kue_kharisma
CACHE_STORE=redis
SESSION_DRIVER=database
```

### Database
Default MySQL database with 9 tables + indexes for performance. See DATABASE_SETUP.md for schema.

## 🧪 Testing

```bash
php artisan test
```

## 📞 Support & Issues

Issues and feature requests: [GitHub Issues](link-to-issues)

## 📄 License

MIT License - See LICENSE file for details

---

**Last Updated**: April 2026  
**Version**: 1.0.0
