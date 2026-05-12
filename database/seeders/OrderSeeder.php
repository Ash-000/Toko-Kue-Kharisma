<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('email', '!=', 'admin@gmail.com')->get();
        $products = Product::all();

        // Create 5 pending orders
        foreach ($users->take(3) as $index => $user) {
            $order = Order::create([
                'order_number' => 'ORD' . str_pad($index + 1, 8, '0', STR_PAD_LEFT),
                'user_id' => $user->id,
                'subtotal' => 0,
                'shipping_cost' => 5000,
                'discount' => 0,
                'total' => 0,
                'payment_method' => 'gopay',
                'status' => 'pending',
            ]);

            // Add random products to order
            $orderProducts = $products->random(rand(2, 4));
            $subtotal = 0;

            foreach ($orderProducts as $product) {
                $quantity = rand(1, 5);
                $itemSubtotal = $product->price * $quantity;
                $subtotal += $itemSubtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            // Update order total
            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + 5000,
            ]);
        }
    }
}
