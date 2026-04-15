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

    protected function getStats(): array
    {
        $pendingOrders   = Order::where('status', 'pending')->count();
        $totalOrders     = Order::count();
        $totalRevenue    = Order::where('status', 'completed')->sum('total');
        $totalProducts   = Product::count();
        $totalCustomers  = User::where('role', 'user')->count();

        return [
            Stat::make('Pesanan Masuk', $pendingOrders)
                ->description('Menunggu verifikasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingOrders > 0 ? 'warning' : 'success')
                ->icon('heroicon-o-shopping-cart'),

            Stat::make('Total Pesanan', $totalOrders)
                ->description('Semua waktu')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->icon('heroicon-o-clipboard-document-list'),

            Stat::make('Total Revenue', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Dari pesanan selesai')
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
        ];
    }
}
