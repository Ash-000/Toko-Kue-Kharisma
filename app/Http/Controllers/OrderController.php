<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function history()
    {
        // Get orders for logged in user
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('riwayat', compact('orders'));
    }

    public function historyJson()
    {
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    'order_number' => $order->order_number,
                    'created_at' => $order->created_at->format('d F Y, H:i'),
                    'status' => $order->status,
                    'total' => $order->total,
                    'order_items' => $order->orderItems->map(function ($item) {
                        return [
                            'quantity' => $item->quantity,
                            'name' => $item->product->name ?? '-',
                        ];
                    }),
                ];
            });

        return response()->json(['orders' => $orders]);
    }
}
