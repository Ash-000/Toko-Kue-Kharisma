<?php

namespace App\Helpers;

use App\Models\Order;

class WhatsAppHelper
{
    public static function buildUrl(Order $order): ?string
    {
        $phone = $order->user?->phone;

        if (!$phone) {
            return null;
        }

        // Normalisasi nomor: hapus leading 0, tambah kode negara 62
        $phone = '62' . ltrim(preg_replace('/\D/', '', $phone), '0');

        $items = $order->orderItems->map(function ($item) {
            return "- {$item->product->name} ({$item->quantity})";
        })->join("\n");

        $message = "*Pesanan Anda Telah Diverifikasi!*\n\n"
            . "Halo {$order->user->name},\n\n"
            . "Pesanan Anda dengan nomor *#{$order->order_number}* telah kami verifikasi.\n\n"
            . "Detail Pesanan:\n{$items}\n\n"
            . "Total: *Rp " . number_format($order->total, 0, ',', '.') . "*\n"
            . "Metode Bayar: " . strtoupper($order->payment_method) . "\n\n"
            . "Pesanan Anda sedang kami proses. Terima kasih telah berbelanja di Toko Kue Kharisma! 🎂";

        return "https://wa.me/{$phone}?text=" . urlencode($message);
    }
}
