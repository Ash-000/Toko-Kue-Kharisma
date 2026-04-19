<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('ulasan', compact('reviews'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.',
            ], 401);
        }

        $request->validate([
            'name'         => 'required|string|max:255',
            'rating'       => 'required|integer|min:1|max:5',
            'review'       => 'required|string',
            'order_number' => 'required|string',
        ]);

        // Pastikan order milik user yang login dan statusnya completed
        $order = Order::where('order_number', $request->order_number)
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan atau belum selesai.',
            ], 403);
        }

        // Cek apakah order ini sudah pernah diberi ulasan
        $alreadyReviewed = Review::where('order_number', $request->order_number)->exists();
        if ($alreadyReviewed) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memberikan ulasan untuk pesanan ini.',
            ], 422);
        }

        Review::create([
            'name'         => $request->name,
            'order_number' => $request->order_number,
            'rating'       => $request->rating,
            'review'       => $request->review,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil ditambahkan. Terima kasih!'
        ]);
    }
}
