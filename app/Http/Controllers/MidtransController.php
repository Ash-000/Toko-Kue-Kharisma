<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    /**
     * Webhook endpoint: Midtrans akan POST notifikasi transaksi ke sini.
     */
    public function notification(Request $request)
    {
        $payload = $request->all();

        $orderId      = $payload['order_id'] ?? null;
        $statusCode   = (string) ($payload['status_code'] ?? '');
        $grossAmount  = (string) ($payload['gross_amount'] ?? '');
        $signatureKey = (string) ($payload['signature_key'] ?? '');

        if (!$orderId) {
            return response()->json(['message' => 'order_id missing'], 400);
        }

        $serverKey = (string) config('services.midtrans.server_key');
        if ($serverKey === '') {
            return response()->json(['message' => 'server key not configured'], 500);
        }

        // Validasi signature sesuai dokumentasi Midtrans
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        if (!hash_equals($expectedSignature, $signatureKey)) {
            Log::warning('Midtrans signature mismatch', ['order_id' => $orderId]);
            return response()->json(['message' => 'invalid signature'], 401);
        }

        // Cari order via midtrans_order_id (format: ORD-xxx-timestamp)
        $order = Order::where('midtrans_order_id', $orderId)->first();
        if (!$order) {
            $order = Order::where('order_number', $orderId)->first();
        }
        if (!$order) {
            Log::warning('Midtrans webhook: order not found', ['order_id' => $orderId]);
            return response()->json(['message' => 'order not found'], 404);
        }

        $transactionStatus = (string) ($payload['transaction_status'] ?? '');
        $paymentType       = (string) ($payload['payment_type'] ?? '');

        $order->midtrans_order_id            = $orderId;
        $order->midtrans_transaction_id      = $payload['transaction_id'] ?? $order->midtrans_transaction_id;
        $order->midtrans_payment_type        = $paymentType ?: $order->midtrans_payment_type;
        $order->midtrans_transaction_status  = $transactionStatus ?: $order->midtrans_transaction_status;
        $order->midtrans_raw_notification    = $payload;

        if (in_array($transactionStatus, ['capture', 'settlement'], true)) {
            $order->status = 'in_progress'; // QRIS berhasil → langsung diproses
            // Kirim notifikasi ke user
            \App\Models\UserNotification::notify(
                $order->user_id,
                'Pembayaran Berhasil! 🎉',
                "Pesanan #{$order->order_number} telah dibayar dan sedang diproses.",
                'success'
            );
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'], true)) {
            $order->status = 'cancelled';
            \App\Models\UserNotification::notify(
                $order->user_id,
                'Pembayaran Gagal',
                "Pesanan #{$order->order_number} dibatalkan karena pembayaran tidak berhasil.",
                'warning'
            );
        } else {
            $order->status = 'pending';
        }

        $order->save();

        return response()->json(['message' => 'ok']);
    }

    /**
     * Sandbox only: simulate QRIS payment via Midtrans API
     * Usage: GET /dev/simulate-qris/{midtransOrderId}
     */
    public function simulateQris($midtransOrderId)
    {
        if (!app()->environment('local')) {
            abort(404);
        }

        $serverKey = config('services.midtrans.server_key');

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => "https://api.sandbox.midtrans.com/v2/{$midtransOrderId}/accept",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => '{}',
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($serverKey . ':'),
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
        ]);

        $result   = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response = json_decode($result, true);

        return response()->json([
            'http_code'         => $httpCode,
            'midtrans_response' => $response,
            'order_id'          => $midtransOrderId,
        ]);
    }

    /**
     * Sandbox only: proxy QR image dari Midtrans agar bisa diakses tanpa auth
     * Usage: GET /dev/qris-image/{transaction_id}
     */
    public function qrisImage($midtransOrderId)
    {
        if (!app()->environment('local')) {
            abort(404);
        }

        $serverKey = config('services.midtrans.server_key');

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => "https://api.sandbox.midtrans.com/v2/qris/{$midtransOrderId}/qr-code",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Accept: image/png',
                'Authorization: Basic ' . base64_encode($serverKey . ':'),
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
        ]);

        $imageData = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || empty($imageData)) {
            return response()->json(['error' => 'QR image not found', 'http_code' => $httpCode], 404);
        }

        return response($imageData, 200)->header('Content-Type', 'image/png');
    }

    /**
     * Sandbox only: langsung set order jadi in_progress (simulasi webhook)
     */
    public function devPayOrder($orderNumber)
    {
        if (!app()->environment('local')) {
            abort(404);
        }

        $order = \App\Models\Order::where('order_number', $orderNumber)
            ->orWhere('midtrans_order_id', $orderNumber)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->status = 'in_progress';
        $order->save();

        return response()->json([
            'success'      => true,
            'order_number' => $order->order_number,
            'status'       => $order->status,
            'message'      => 'Status berhasil diubah ke in_progress',
        ]);
    }
}
