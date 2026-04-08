<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    protected $casts = [
        'quantity' => 'integer'
    ];

    /**
     * Relationship dengan User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship dengan Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get subtotal untuk item cart ini
     */
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }

    /**
     * Scope untuk user tertentu
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Update quantity atau create jika belum ada
     */
    public static function updateOrCreateItem($userId, $productId, $quantity)
    {
        $cartItem = static::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Jika item sudah ada, tambahkan quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
            return $cartItem;
        } else {
            // Jika item belum ada, buat baru
            return static::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }
    }

    /**
     * Get total items di cart untuk user
     */
    public static function getTotalItems($userId)
    {
        return static::forUser($userId)->sum('quantity');
    }

    /**
     * Get total harga cart untuk user
     */
    public static function getTotalPrice($userId)
    {
        return static::forUser($userId)
            ->with('product')
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
    }
}
