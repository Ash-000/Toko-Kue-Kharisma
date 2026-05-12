<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'subtotal',
        'shipping_cost',
        'discount',
        'total',
        'payment_method',
        'notes',
        'delivery_address',
        'status',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'midtrans_payment_type',
        'midtrans_transaction_status',
        'midtrans_raw_notification',
    ];

    protected $casts = [
        'midtrans_raw_notification' => 'array',
        'subtotal'                  => 'decimal:2',
        'shipping_cost'             => 'decimal:2',
        'discount'                  => 'decimal:2',
        'total'                     => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentProof()
    {
        return $this->hasOne(PaymentProof::class);
    }
}
