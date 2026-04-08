<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $totalCustomers = User::where('role', 'user')->count();

        $recentOrders = Order::with('user')->latest()->take(10)->get();
        $orders = Order::with('user')->latest()->get();
        $products = Product::all();
        $customers = User::where('role', 'user')->get();
        $newOrdersCount = Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'totalCustomers',
            'recentOrders',
            'orders',
            'products',
            'customers',
            'newOrdersCount'
        ));
    }

    public function newOrders()
    {
        $newOrders = Order::with(['user', 'orderItems.product'])
            ->where('status', 'pending')
            ->latest()
            ->get();
        
        $newOrdersCount = $newOrders->count();

        return view('admin.new-orders', compact('newOrders', 'newOrdersCount'));
    }

    public function verifyOrder($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        
        // Update status to verified
        $order->update(['status' => 'verified']);

        // Prepare WhatsApp message
        $phone = $order->user->phone;
        $message = $this->generateWhatsAppMessage($order);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diverifikasi',
            'whatsapp_url' => $this->getWhatsAppUrl($phone, $message),
            'order' => $order
        ]);
    }

    private function generateWhatsAppMessage($order)
    {
        $items = $order->orderItems->map(function($item) {
            return "- {$item->product->name} ({$item->quantity})";
        })->join("\n");

        return "*Pesanan Baru Masuk!*\n\n"
            . "Nama: {$order->user->name}\n"
            . "No Pesanan: #{$order->order_number}\n\n"
            . "Pesanan:\n{$items}\n\n"
            . "Total: Rp " . number_format($order->total, 0, ',', '.') . "\n\n"
            . "Segera verifikasi pesanan di dashboard.\n\n"
            . "_Terima kasih telah berbelanja di Toko Kue Kharisma!_";
    }

    private function getWhatsAppUrl($phone, $message)
    {
        // Remove leading 0 and add 62 (Indonesia country code)
        $phone = '62' . ltrim($phone, '0');
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }
}
