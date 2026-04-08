<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $cartItems = Cart::forUser($user->id)
            ->with('product')
            ->get();

        $totalItems = Cart::getTotalItems($user->id);
        $totalPrice = Cart::getTotalPrice($user->id);

        return view('cart', compact('cartItems', 'totalItems', 'totalPrice', 'user'));
    }

    /**
     * Menambah produk ke keranjang (AJAX)
     */
    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        // Cek apakah produk ada
        $product = Product::find($productId);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        // Update atau create cart item
        $cartItem = Cart::updateOrCreateItem($user->id, $productId, $quantity);

        // Hitung total items dan total price
        $totalItems = Cart::getTotalItems($user->id);
        $totalPrice = Cart::getTotalPrice($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'data' => [
                'product_name' => $product->name,
                'quantity' => $cartItem->quantity,
                'total_items' => $totalItems,
                'total_price' => $totalPrice
            ]
        ]);
    }

    /**
     * Update quantity item di keranjang (AJAX)
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        $productId = $request->product_id;
        $quantity = $request->quantity;

        if ($quantity == 0) {
            // Hapus item jika quantity 0
            Cart::forUser($user->id)->where('product_id', $productId)->delete();
        } else {
            // Update quantity
            Cart::forUser($user->id)
                ->where('product_id', $productId)
                ->update(['quantity' => $quantity]);
        }

        $totalItems = Cart::getTotalItems($user->id);
        $totalPrice = Cart::getTotalPrice($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diperbarui',
            'data' => [
                'total_items' => $totalItems,
                'total_price' => $totalPrice
            ]
        ]);
    }

    /**
     * Hapus item dari keranjang (AJAX)
     */
    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        $productId = $request->product_id;

        $cartItem = Cart::forUser($user->id)
            ->where('product_id', $productId)
            ->with('product')
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan di keranjang'
            ], 404);
        }

        $productName = $cartItem->product->name;
        $cartItem->delete();

        $totalItems = Cart::getTotalItems($user->id);
        $totalPrice = Cart::getTotalPrice($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang',
            'data' => [
                'product_name' => $productName,
                'total_items' => $totalItems,
                'total_price' => $totalPrice
            ]
        ]);
    }

    /**
     * Get cart summary (AJAX) - untuk update badge dan summary
     */
    public function summary(): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        $totalItems = Cart::getTotalItems($user->id);
        $totalPrice = Cart::getTotalPrice($user->id);

        return response()->json([
            'success' => true,
            'data' => [
                'total_items' => $totalItems,
                'total_price' => $totalPrice
            ]
        ]);
    }

    /**
     * Clear all cart items
     */
    public function clear(): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        Cart::forUser($user->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }

    /**
     * Get cart item count for badge
     */
    public function count(): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'count' => 0
            ]);
        }

        $totalItems = Cart::getTotalItems($user->id);

        return response()->json([
            'count' => $totalItems
        ]);
    }
}
