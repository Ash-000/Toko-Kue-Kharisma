<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function history()
    {
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Order number yang sudah pernah diberi ulasan
        $reviewedOrders = \App\Models\Review::whereIn(
            'order_number',
            $orders->pluck('order_number')
        )->pluck('order_number')->toArray();

        return view('riwayat', compact('orders', 'reviewedOrders'));
    }

    /**
     * Membuat order baru dari cart user (AJAX)
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,cod',
            'notes'          => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        // Cek alamat user
        if (empty($user->address)) {
            return response()->json([
                'success'          => false,
                'message'          => 'Silakan lengkapi alamat pengiriman terlebih dahulu.',
                'require_address'  => true,
            ], 422);
        }

        // Ambil cart items beserta produk
        $cartItems = Cart::forUser($user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang belanja kosong',
            ], 422);
        }

        // Tidak ada validasi stok karena produk tidak menggunakan sistem stok

        DB::beginTransaction();
        try {
            $subtotal     = $cartItems->sum(fn($i) => $i->quantity * $i->product->price);
            $shippingCost = 5000;
            $discount     = 0;
            $total        = $subtotal + $shippingCost - $discount;

            // Generate order number unik
            $orderNumber = 'ORD-' . strtoupper(uniqid());

            $order = Order::create([
                'order_number'     => $orderNumber,
                'user_id'          => $user->id,
                'subtotal'         => $subtotal,
                'shipping_cost'    => $shippingCost,
                'discount'         => $discount,
                'total'            => $total,
                'payment_method'   => $request->payment_method,
                'notes'            => $request->notes,
                'delivery_address' => $user->address,
                'status'           => 'pending',
            ]);

            // Buat order items & kurangi stok
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                    'subtotal'   => $item->quantity * $item->product->price,
                ]);

                // Kurangi stok produk dihapus - produk tidak menggunakan sistem stok
            }

            // Kosongkan cart
            Cart::forUser($user->id)->delete();

            DB::commit();

            return response()->json([
                'success'      => true,
                'message'      => 'Pesanan berhasil dibuat',
                'order_number' => $order->order_number,
                'total'        => $order->total,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan, silakan coba lagi',
            ], 500);
        }
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
