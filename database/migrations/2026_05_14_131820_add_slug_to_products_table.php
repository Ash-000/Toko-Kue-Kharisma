<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Product;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('name');
            }
        });

        // Generate slug untuk produk yang sudah ada
        Product::whereNull('slug')->orWhere('slug', '')->get()->each(function ($product) {
            $slug = Str::slug($product->name);
            $original = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $original . '-' . $count++;
            }
            $product->update(['slug' => $slug]);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
