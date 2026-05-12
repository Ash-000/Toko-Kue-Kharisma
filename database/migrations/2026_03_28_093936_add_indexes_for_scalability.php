<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Index untuk users table - hanya tambah yang belum ada
        Schema::table('users', function (Blueprint $table) {
            // Email index biasanya sudah ada dari migration awal
            if (!$this->indexExists('users', 'users_role_index')) {
                $table->index('role');
            }
        });

        // Index untuk products table
        Schema::table('products', function (Blueprint $table) {
            if (!$this->indexExists('products', 'products_name_index')) {
                $table->index('name');
            }
            if (!$this->indexExists('products', 'products_price_index')) {
                $table->index('price');
            }
        });

        // Index untuk orders table
        Schema::table('orders', function (Blueprint $table) {
            if (!$this->indexExists('orders', 'orders_user_id_index')) {
                $table->index('user_id');
            }
            if (!$this->indexExists('orders', 'orders_status_index')) {
                $table->index('status');
            }
            if (!$this->indexExists('orders', 'orders_created_at_index')) {
                $table->index('created_at');
            }
        });

        // Index untuk order_items table
        Schema::table('order_items', function (Blueprint $table) {
            if (!$this->indexExists('order_items', 'order_items_order_id_index')) {
                $table->index('order_id');
            }
            if (!$this->indexExists('order_items', 'order_items_product_id_index')) {
                $table->index('product_id');
            }
        });

        // Index untuk reviews table
        Schema::table('reviews', function (Blueprint $table) {
            if (!$this->indexExists('reviews', 'reviews_rating_index')) {
                $table->index('rating');
            }
            if (!$this->indexExists('reviews', 'reviews_created_at_index')) {
                $table->index('created_at');
            }
        });
    }

    /**
     * Check if index exists
     */
    private function indexExists($table, $indexName)
    {
        $indexes = \DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
        return count($indexes) > 0;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email']);
            $table->dropIndex(['role']);
            $table->dropIndex(['email', 'role']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['price']);
            $table->dropIndex(['name', 'price']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['order_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['order_id', 'product_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['product_id']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['rating']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['product_id', 'rating']);
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['last_activity']);
        });
    }
};
