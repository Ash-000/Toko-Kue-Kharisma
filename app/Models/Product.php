<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image_url',
    ];

    /**
     * Otomatis return URL yang benar:
     * - Kalau path dari storage (tidak diawali http/https atau /images), pakai Storage::url()
     * - Kalau URL lama (/images/products/...), pakai asset()
     * - Kalau URL eksternal (http/https), langsung return
     */
    public function getImageUrlAttribute($value): string
    {
        if (!$value) {
            return asset('images/products/default.jpg');
        }

        // URL eksternal
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        // Path lama dari /images/...
        if (str_starts_with($value, '/images/') || str_starts_with($value, 'images/')) {
            return asset($value);
        }

        // Path baru dari storage (products/filename.jpg)
        return Storage::disk('public')->url($value);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
