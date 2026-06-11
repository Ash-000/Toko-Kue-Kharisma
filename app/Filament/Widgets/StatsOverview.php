<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    // Polling 30 detik (hemat resource, sebelumnya 15s)
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        // 1 query untuk semua statistik Order (sebelumnya 4 query terpisah)
        $orderStats = Order::selectRaw("
            COUNT(*) as total_orders,
            SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) as processing,
            SUM(CASE WHEN status = 'completed' THEN total ELSE 0 END) as revenue,
            SUM(CASE WHEN status IN ('shipping','completed') THEN 1 ELSE 0 END) as shipped
        ")->first();

        $totalProducts  = Product::count();
        $totalCustomers = User::where('role', 'user')->count();
        $processing     = (int) ($orderStats->processing ?? 0);

        return [
            Stat::make('Pesanan Masuk', $processing)
                ->description('Sedang Diproses')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color($processing > 0 ? 'warning' : 'gray')
                ->icon('heroicon-o-shopping-cart'),

            Stat::make('Total Pesanan', (int) $orderStats->total_orders)
                ->description('Seluruh transaksi')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->icon('heroicon-o-clipboard-document-list'),

            Stat::make('Total Revenue', 'Rp ' . number_format((float) $orderStats->revenue, 0, ',', '.'))
                ->description('Pesanan selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->icon('heroicon-o-currency-dollar'),

            Stat::make('Total Pelanggan', $totalCustomers)
                ->description('User terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->icon('heroicon-o-users'),

            Stat::make('Total Produk', $totalProducts)
                ->description('Produk tersedia')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->icon('heroicon-o-cake'),

            Stat::make('Pesanan Terkirim', (int) $orderStats->shipped)
                ->description('Sudah dikirim & Selesai')
                ->descriptionIcon('heroicon-m-truck')
                ->color('success'),
        ];
    }
}