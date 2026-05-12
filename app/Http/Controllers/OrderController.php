<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function history()
    {
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $reviewedOrders = \App\Models\Review::whereIn(
            'order_number',
            $orders->pluck('order_number')
        )->pluck('order_number')->toArray();

        return view('riwayat', compact('orders', 'reviewedOrders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,cod,bank_transfer',
            'notes'          => 'nullable|string|max:500',
        ]);

        $user = Auth::user()->fresh();
        $userAddress = $user->address ?? $user->alamat;

        // Cek alamat pengiriman (sesuai User Summary)
        if (empty($userAddress)) {
            return response()->json([
                'success'         => false,
                'message'         => 'Silakan lengkapi alamat pengiriman di profil terlebih dahulu.',
                'require_address' => true,
            ], 422);
        }

        $cartItems = Cart::forUser($user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang belanja kosong',
            ], 422);
        }

        DB::beginTransaction();
        try {
            $subtotal     = $cartItems->sum(function ($item) {
                return $item->quantity * ($item->price ?? $item->product->price);
            });
            $shippingCost = 0;
            $discount     = 0;
            $total        = $subtotal - $discount;

            $orderNumber = 'ORD-' . strtoupper(uniqid());

            // Status: QRIS pending dulu sampai webhook konfirmasi, COD langsung in_progress
            $status = $request->payment_method === 'cod' ? 'in_progress' : 'pending';

$order = Order::create([
    'order_number'     => $orderNumber,
    'user_id'          => $user->id,
    'subtotal'         => $subtotal,
    'shipping_cost'    => $shippingCost,
    'discount'         => $discount,
    'total'            => $total,
    'payment_method'   => $request->payment_method,
    'notes'            => $request->notes,
    'delivery_address' => $userAddress,
    'status'           => $status, 
]);

            foreach ($cartItems as $item) {
                $itemPrice = $item->price ?? $item->product->price;
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $itemPrice,
                    'subtotal'   => $item->quantity * $itemPrice,
                ]);
            }

            DB::commit();

            if ($request->payment_method === 'qris') {
                $qrisResult = $this->processQrisPayment($order, $user, $cartItems, $shippingCost);
                
                // Jika Snap Token berhasil dibuat, hapus keranjang
                $data = $qrisResult->getData();
                if (isset($data->success) && $data->success) {
                    Cart::forUser($user->id)->delete();
                }
                return $qrisResult;
            }

            Cart::forUser($user->id)->delete();

            if ($request->payment_method === 'bank_transfer') {
                \App\Models\UserNotification::notify(
                    $user->id,
                    'Pesanan Menunggu Pembayaran 🏦',
                    "Pesanan #{$order->order_number} berhasil dibuat. Silakan upload bukti transfer.",
                    'info'
                );
                return response()->json([
                    'success' => true,
                    'message' => 'Pesanan berhasil dibuat. Silakan upload bukti transfer.',
                    'redirect' => route('payment.upload', $order->id),
                ]);
            }

            // COD
            \App\Models\UserNotification::notify(
                $user->id,
                'Pesanan Diterima! 🛍️',
                "Pesanan #{$order->order_number} sedang diproses. Bayar saat barang tiba.",
                'success'
            );

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat! Pesanan sedang diproses. Terimakasih atas pembelian Anda 🙏',
                'order_number' => $order->order_number,
                'status' => 'in_progress',
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Order Store Error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Sistem Error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function processQrisPayment($order, $user, $cartItems, $shippingCost)
    {
        $serverKey    = config('services.midtrans.server_key');
        $clientKey    = config('services.midtrans.client_key');
        $isProduction = config('services.midtrans.is_production', false);

        try {
            if (empty($serverKey) || empty($clientKey)) {
                throw new \Exception('Midtrans configuration incomplete');
            }

            MidtransConfig::$serverKey    = $serverKey;
            MidtransConfig::$isProduction = $isProduction;
            MidtransConfig::$isSanitized  = true;
            MidtransConfig::$is3ds        = true;

            if (!$isProduction) {
                MidtransConfig::$curlOptions = [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
                    CURLOPT_HTTPHEADER     => [],
                ];
            }

            $item_details = [];
            foreach ($cartItems as $item) {
                $price    = (int) ($item->price ?? $item->product->price);
                $itemName = $item->product->name ?? 'Produk';
                $item_details[] = [
                    'id'       => 'PRD-' . $item->product_id,
                    'price'    => $price,
                    'quantity' => (int) $item->quantity,
                    'name'     => (string) substr($itemName, 0, 50),
                ];
            }

            $midtransOrderId = $order->order_number . '-' . time();
            $order->midtrans_order_id = $midtransOrderId;
            $order->save();

            $params = [
                'transaction_details' => [
                    'order_id'     => $midtransOrderId,
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => [
                    'first_name' => $user->name  ?? 'Pelanggan',
                    'email'      => $user->email ?? 'customer@mail.com',
                    'phone'      => $user->phone ?? '08123456789',
                ],
                'item_details' => $item_details,
                'callbacks' => [
                    'finish'  => url('/riwayat'),
                    'error'   => url('/riwayat'),
                    'pending' => url('/riwayat'),
                ],
            ];

            Log::info('Midtrans Snap request', [
                'order_id' => $midtransOrderId,
                'amount'   => $order->total,
            ]);

            $snapToken = Snap::getSnapToken($params);

            if (!$snapToken) {
                throw new \Exception('Failed to generate Snap token');
            }

            Log::info('Snap token generated', ['order' => $order->order_number]);

            return response()->json([
                'success'             => true,
                'snap_token'          => $snapToken,
                'midtrans_client_key' => $clientKey,
                'order_number'        => $order->order_number,
                'midtrans_order_id'   => $midtransOrderId,
            ]);

        } catch (\Exception $e) {
            Log::error('MIDTRANS SNAP ERROR', [
                'message' => $e->getMessage(),
                'order'   => $order->order_number,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi Midtrans: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function cancelOrder($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Hanya bisa cancel kalau masih pending
        if ($order->status === 'pending') {
            $order->status = 'cancelled';
            $order->save();
        }

        return response()->json([
            'success' => true,
            'status'  => $order->status,
        ]);
    }

    public function checkStatus($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json([
            'status'       => $order->status,
            'order_number' => $order->order_number,
        ]);
    }

    public function historyJson()
    {
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return response()->json(['orders' => $orders]);
    }
    
    // Tambahkan di dalam class OrderController

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:shipping,completed'
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . $request->status);
}
}